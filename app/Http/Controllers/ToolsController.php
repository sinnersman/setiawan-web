<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Free network diagnostic tools.
 *
 * Security rules (strict):
 * - Hostname / IP validation only (regex + filter_var), max lengths enforced.
 * - No shell execution of any kind (no exec/system/passthru/shell_exec/backticks).
 * - Port scanner: fixed allow-list of 16 common ports, 1s timeout, session throttle.
 */
class ToolsController extends Controller
{
    /** Slug => meta. */
    public const TOOLS = [
        'initialize-scan' => [
            'title' => 'Initialize Scan',
            'description' => 'Pemeriksaan awal host: resolusi DNS + keterjangkauan port 80/443 dengan latensi.',
            'placeholder' => 'example.com',
            'field' => 'host',
        ],
        'dns-lookup' => [
            'title' => 'DNS Lookup',
            'description' => 'Lihat record DNS (A, AAAA, MX, TXT, NS, CNAME) sebuah domain.',
            'placeholder' => 'example.com',
            'field' => 'host',
        ],
        'reverse-dns' => [
            'title' => 'Reverse DNS',
            'description' => 'Cari hostname (PTR) dari sebuah alamat IP.',
            'placeholder' => '8.8.8.8',
            'field' => 'ip',
        ],
        'port-scanner' => [
            'title' => 'Port Scanner',
            'description' => 'Pindai maksimal 16 port umum (timeout 1 detik per port).',
            'placeholder' => 'example.com',
            'field' => 'host',
        ],
        'ssl-checker' => [
            'title' => 'SSL Checker',
            'description' => 'Periksa sertifikat TLS: penerbit, masa berlaku, SAN, sisa hari.',
            'placeholder' => 'example.com',
            'field' => 'host',
        ],
        'http-headers' => [
            'title' => 'HTTP Headers',
            'description' => 'Tampilkan status dan response header sebuah URL.',
            'placeholder' => 'https://example.com',
            'field' => 'url',
        ],
        'subnet-calc' => [
            'title' => 'Subnet Calculator',
            'description' => 'Hitung network, broadcast, mask, dan rentang host IPv4 (CIDR).',
            'placeholder' => '192.168.1.0/24',
            'field' => 'cidr',
        ],
        'ip-lookup' => [
            'title' => 'IP Lookup',
            'description' => 'Resolusi & klasifikasi IP/hostname (publik vs privat, reverse DNS).',
            'placeholder' => '8.8.8.8 atau example.com',
            'field' => 'query',
        ],
    ];

    /** Fixed allow-list for the port scanner (16 common ports). */
    public const COMMON_PORTS = [
        21 => 'FTP', 22 => 'SSH', 23 => 'Telnet', 25 => 'SMTP',
        53 => 'DNS', 80 => 'HTTP', 110 => 'POP3', 143 => 'IMAP',
        443 => 'HTTPS', 465 => 'SMTPS', 587 => 'Submission', 993 => 'IMAPS',
        995 => 'POP3S', 3306 => 'MySQL', 8080 => 'HTTP-Alt', 8443 => 'HTTPS-Alt',
    ];

    /** Seconds between port scans per session. */
    public const PORT_SCAN_THROTTLE_SECONDS = 30;

    public function index(): View
    {
        return view('tools.index', ['tools' => self::TOOLS]);
    }

    public function show(string $slug): View
    {
        $tool = self::TOOLS[$slug] ?? abort(404);
        return view('tools.' . $slug, [
            'tools' => self::TOOLS,
            'meta' => $tool,
            'slug' => $slug,
            'result' => null,
        ]);
    }

    public function run(Request $request, string $slug)
    {
        $tool = self::TOOLS[$slug] ?? abort(404);

        $result = match ($slug) {
            'initialize-scan' => $this->runInitializeScan($request),
            'dns-lookup' => $this->runDnsLookup($request),
            'reverse-dns' => $this->runReverseDns($request),
            'port-scanner' => $this->runPortScanner($request),
            'ssl-checker' => $this->runSslChecker($request),
            'http-headers' => $this->runHttpHeaders($request),
            'subnet-calc' => $this->runSubnetCalc($request),
            'ip-lookup' => $this->runIpLookup($request),
        };

        return view('tools.' . $slug, [
            'tools' => self::TOOLS,
            'meta' => $tool,
            'slug' => $slug,
            'result' => $result,
            'input' => $request->only(array_keys($request->all())),
        ]);
    }

    // ------------------------------------------------------------------
    // Validators
    // ------------------------------------------------------------------

    /** Strict hostname check. Returns normalized host or null. */
    private function cleanHostname(?string $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }
        $host = strtolower(trim($value));
        $host = rtrim($host, '.');
        if ($host === '' || strlen($host) > 253) {
            return null;
        }
        // Reject schemes, paths, ports, spaces, underscores.
        if (str_contains($host, '://') || str_contains($host, '/') || str_contains($host, ' ') || str_contains($host, ':')) {
            // Allow nothing after colon (no ports); plain hostnames only.
            return null;
        }
        if (! filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            return null;
        }
        if (! preg_match('/^[a-z0-9]([a-z0-9\-\.]{0,251}[a-z0-9])?$/', $host)) {
            return null;
        }
        if (str_contains($host, '..')) {
            return null;
        }

        return $host;
    }

    private function cleanIp(?string $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }
        $ip = trim($value);
        if (strlen($ip) > 45) {
            return null;
        }

        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : null;
    }

    /** Hostname or IP → resolved IPv4/IPv6 string, or null on failure. */
    private function resolveToIp(string $host): ?string
    {
        if (filter_var($host, FILTER_VALIDATE_IP)) {
            return $host;
        }
        // Prefer A record via DNS; fallback to gethostbyname.
        $records = @dns_get_record($host, DNS_A);
        if (is_array($records) && isset($records[0]['ip'])) {
            return $records[0]['ip'];
        }
        $ip = @gethostbyname($host);
        if ($ip !== $host && filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }

        return null;
    }

    private function err(string $message): array
    {
        return ['ok' => false, 'error' => $message];
    }

    // ------------------------------------------------------------------
    // Tools
    // ------------------------------------------------------------------

    private function runInitializeScan(Request $request): array
    {
        $validated = $request->validate(['host' => 'required|string|max:253']);
        $host = $this->cleanHostname($validated['host']);
        if ($host === null) {
            return $this->err('Hostname tidak valid. Gunakan domain valid, mis. example.com.');
        }
        $ip = $this->resolveToIp($host);
        if ($ip === null) {
            return $this->err("Host '{$host}' tidak dapat di-resolve ke alamat IP.");
        }
        $checks = [];
        foreach ([80 => 'HTTP', 443 => 'HTTPS'] as $port => $label) {
            $start = microtime(true);
            $fp = @fsockopen($ip, $port, $errno, $errstr, 2.0);
            $ms = round((microtime(true) - $start) * 1000, 1);
            if (is_resource($fp)) {
                fclose($fp);
                $checks[] = ['port' => $port, 'service' => $label, 'status' => 'reachable', 'latency_ms' => $ms];
            } else {
                $checks[] = ['port' => $port, 'service' => $label, 'status' => 'unreachable', 'latency_ms' => $ms];
            }
        }

        return ['ok' => true, 'host' => $host, 'ip' => $ip, 'checks' => $checks];
    }

    private function runDnsLookup(Request $request): array
    {
        $validated = $request->validate(['host' => 'required|string|max:253']);
        $host = $this->cleanHostname($validated['host']);
        if ($host === null) {
            return $this->err('Hostname tidak valid. Gunakan domain valid, mis. example.com.');
        }
        $groups = [];
        $map = ['A' => DNS_A, 'AAAA' => DNS_AAAA, 'MX' => DNS_MX, 'TXT' => DNS_TXT, 'NS' => DNS_NS, 'CNAME' => DNS_CNAME];
        foreach ($map as $label => $type) {
            $records = @dns_get_record($host, $type);
            $groups[$label] = is_array($records) ? array_slice($records, 0, 10) : [];
        }
        $total = array_sum(array_map('count', $groups));
        if ($total === 0) {
            return $this->err("Tidak ada record DNS yang ditemukan untuk '{$host}'.");
        }

        return ['ok' => true, 'host' => $host, 'groups' => $groups];
    }

    private function runReverseDns(Request $request): array
    {
        $validated = $request->validate(['ip' => 'required|string|max:45']);
        $ip = $this->cleanIp($validated['ip']);
        if ($ip === null) {
            return $this->err('Alamat IP tidak valid.');
        }
        $hostname = @gethostbyaddr($ip);
        if ($hostname === false || $hostname === $ip) {
            return $this->err("Tidak ada record PTR untuk '{$ip}'.");
        }

        return ['ok' => true, 'ip' => $ip, 'hostname' => $hostname];
    }

    private function runPortScanner(Request $request): array
    {
        // Session throttle.
        $last = (int) $request->session()->get('tools.port_scan_at', 0);
        $wait = self::PORT_SCAN_THROTTLE_SECONDS - (time() - $last);
        if ($wait > 0) {
            return $this->err("Terlalu sering. Coba lagi dalam {$wait} detik.");
        }

        $validated = $request->validate([
            'host' => 'required|string|max:253',
            'ports' => 'nullable|array|max:16',
            'ports.*' => 'integer',
        ]);

        $host = $this->cleanHostname($validated['host']);
        if ($host === null) {
            return $this->err('Hostname tidak valid. Gunakan domain valid, mis. example.com.');
        }

        $requested = $validated['ports'] ?? [80, 443];
        // Intersect with allow-list, cap at 16.
        $ports = array_values(array_intersect(array_map('intval', $requested), array_keys(self::COMMON_PORTS)));
        $ports = array_slice(array_unique($ports), 0, 16);
        if (empty($ports)) {
            return $this->err('Pilih minimal satu port dari daftar yang tersedia.');
        }

        $ip = $this->resolveToIp($host);
        if ($ip === null) {
            return $this->err("Host '{$host}' tidak dapat di-resolve ke alamat IP.");
        }

        $results = [];
        foreach ($ports as $port) {
            $start = microtime(true);
            $fp = @fsockopen($ip, $port, $errno, $errstr, 1.0);
            $ms = round((microtime(true) - $start) * 1000, 1);
            if (is_resource($fp)) {
                fclose($fp);
                $results[] = ['port' => $port, 'service' => self::COMMON_PORTS[$port], 'status' => 'open', 'latency_ms' => $ms];
            } else {
                $results[] = ['port' => $port, 'service' => self::COMMON_PORTS[$port], 'status' => 'closed', 'latency_ms' => $ms];
            }
        }
        $request->session()->put('tools.port_scan_at', time());

        return ['ok' => true, 'host' => $host, 'ip' => $ip, 'results' => $results];
    }

    private function runSslChecker(Request $request): array
    {
        $validated = $request->validate(['host' => 'required|string|max:253']);
        $host = $this->cleanHostname($validated['host']);
        if ($host === null) {
            return $this->err('Hostname tidak valid. Gunakan domain valid, mis. example.com.');
        }
        $ip = $this->resolveToIp($host);
        if ($ip === null) {
            return $this->err("Host '{$host}' tidak dapat di-resolve ke alamat IP.");
        }

        $context = stream_context_create(['ssl' => [
            'capture_peer_cert' => true,
            'verify_peer' => false,
            'verify_peer_name' => false,
            'SNI_enabled' => true,
            'peer_name' => $host,
        ]]);
        $client = @stream_socket_client(
            "ssl://{$host}:443",
            $errno, $errstr, 6.0,
            STREAM_CLIENT_CONNECT, $context
        );
        if ($client === false) {
            return $this->err("Gagal koneksi TLS ke '{$host}:443' ({$errstr}).");
        }
        $params = stream_context_get_params($context);
        fclose($client);
        $cert = $params['options']['ssl']['peer_certificate'] ?? null;
        if (! $cert) {
            return $this->err('Sertifikat tidak dapat diambil.');
        }
        $info = @openssl_x509_parse($cert);
        if ($info === false) {
            return $this->err('Sertifikat tidak dapat di-parse.');
        }
        $now = time();
        $daysLeft = isset($info['validTo_time_t']) ? (int) floor(($info['validTo_time_t'] - $now) / 86400) : null;

        return ['ok' => true, 'host' => $host,
            'subject_cn' => $info['subject']['CN'] ?? '-',
            'issuer' => $info['issuer']['O'] ?? ($info['issuer']['CN'] ?? '-'),
            'valid_from' => isset($info['validFrom_time_t']) ? date('Y-m-d H:i:s', $info['validFrom_time_t']) : '-',
            'valid_to' => isset($info['validTo_time_t']) ? date('Y-m-d H:i:s', $info['validTo_time_t']) : '-',
            'days_left' => $daysLeft,
            'expired' => $daysLeft !== null && $daysLeft < 0,
            'san' => $info['extensions']['subjectAltName'] ?? '-',
        ];
    }

    private function runHttpHeaders(Request $request): array
    {
        $validated = $request->validate(['url' => 'required|string|max:500']);
        $raw = trim($validated['url']);
        if (! preg_match('#^https?://#i', $raw)) {
            $raw = 'https://' . $raw;
        }
        if (strlen($raw) > 500) {
            return $this->err('URL terlalu panjang.');
        }
        $parts = parse_url($raw);
        if (! isset($parts['host'])) {
            return $this->err('URL tidak valid.');
        }
        $host = $this->cleanHostname($parts['host']);
        if ($host === null) {
            return $this->err('Hostname pada URL tidak valid.');
        }
        $url = $parts['scheme'] . '://' . $host
            . (isset($parts['port']) && in_array((int) $parts['port'], [80, 443], true) ? '' : (isset($parts['port']) ? ':' . (int) $parts['port'] : ''))
            . ($parts['path'] ?? '/')
            . (isset($parts['query']) ? '?' . $parts['query'] : '');

        $context = stream_context_create(['http' => [
            'method' => 'HEAD',
            'timeout' => 6.0,
            'follow_location' => 1,
            'max_redirects' => 3,
            'ignore_errors' => true,
            'header' => "User-Agent: setiawan-web-tools/1.0\r\n",
        ]]);
        $headers = @get_headers($url, true, $context);
        if ($headers === false) {
            return $this->err("Gagal mengambil header dari '{$url}'.");
        }

        return ['ok' => true, 'url' => $url, 'headers' => $headers];
    }

    private function runSubnetCalc(Request $request): array
    {
        $validated = $request->validate(['cidr' => 'required|string|max:20']);
        $cidr = trim($validated['cidr']);
        if (! preg_match('#^(\d{1,3}(?:\.\d{1,3}){3})/(\d{1,2})$#', $cidr, $m)) {
            return $this->err('Format CIDR tidak valid. Contoh: 192.168.1.0/24.');
        }
        [, $ip, $prefix] = $m;
        $prefix = (int) $prefix;
        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || $prefix < 0 || $prefix > 32) {
            return $this->err('IPv4 atau prefix tidak valid (prefix 0–32).');
        }
        $ipLong = (int) ip2long($ip);
        $mask = $prefix === 0 ? 0 : (~0 << (32 - $prefix)) & 0xFFFFFFFF;
        $network = $ipLong & $mask;
        $broadcast = $network | (~$mask & 0xFFFFFFFF);
        $total = $prefix === 32 ? 1 : (2 ** (32 - $prefix));
        $usable = $prefix >= 31 ? $total : max($total - 2, 0);

        return ['ok' => true, 'cidr' => "{$ip}/{$prefix}",
            'network' => long2ip($network),
            'broadcast' => long2ip($broadcast),
            'mask' => long2ip($mask),
            'prefix' => $prefix,
            'total' => $total,
            'usable' => $usable,
            'first' => $prefix >= 31 ? long2ip($network) : long2ip($network + 1),
            'last' => $prefix >= 31 ? long2ip($broadcast) : long2ip($broadcast - 1),
        ];
    }

    private function runIpLookup(Request $request): array
    {
        $validated = $request->validate(['query' => 'required|string|max:253']);
        $q = trim($validated['query']);
        $ip = $this->cleanIp($q);
        $host = null;
        if ($ip === null) {
            $host = $this->cleanHostname($q);
            if ($host === null) {
                return $this->err('Masukkan IP atau hostname yang valid.');
            }
            $ip = $this->resolveToIp($host);
            if ($ip === null) {
                return $this->err("Host '{$host}' tidak dapat di-resolve.");
            }
        }
        $isPublic = (bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        $isPrivate = (bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) === false;
        $version = str_contains($ip, ':') ? 'IPv6' : 'IPv4';
        $ptr = @gethostbyaddr($ip);
        $ptr = ($ptr === false || $ptr === $ip) ? null : $ptr;

        return ['ok' => true, 'ip' => $ip, 'hostname' => $host,
            'version' => $version,
            'type' => $isPublic ? 'publik' : ($isPrivate ? 'privat' : 'reserved/khusus'),
            'reverse_dns' => $ptr,
        ];
    }
}
