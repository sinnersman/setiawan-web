<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityToolsController extends Controller
{
    /* ---------- Hash Generator ---------- */
    public function hashGenerator()
    {
        return view('tools.hash-generator', ['result' => null]);
    }

    public function hashGenerate(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string|max:10000',
            'algo' => 'required|in:md5,sha1,sha256,sha512,bcrypt',
        ]);
        $out = [];
        if ($data['algo'] === 'bcrypt') {
            $out['bcrypt'] = password_hash($data['text'], PASSWORD_BCRYPT);
        } else {
            $out = [
                'md5' => md5($data['text']),
                'sha1' => sha1($data['text']),
                'sha256' => hash('sha256', $data['text']),
                'sha512' => hash('sha512', $data['text']),
            ];
            if ($data['algo'] !== 'all') {
                $out = [$data['algo'] => $out[$data['algo']]];
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['input' => $data['text'], 'hashes' => $out]);
        }

        return view('tools.hash-generator', ['result' => $out, 'input' => $data['text'], 'algo' => $data['algo']]);
    }

    /* ---------- Password Generator ---------- */
    public function passGenerator()
    {
        return view('tools.pass-generator', ['result' => null]);
    }

    public function passGenerate(Request $request)
    {
        $data = $request->validate([
            'length' => 'required|integer|min:4|max:128',
            'lower' => 'nullable|boolean',
            'upper' => 'nullable|boolean',
            'digits' => 'nullable|boolean',
            'symbols' => 'nullable|boolean',
        ]);
        $pool = '';
        if ($request->boolean('lower', true)) $pool .= 'abcdefghijklmnopqrstuvwxyz';
        if ($request->boolean('upper', true)) $pool .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($request->boolean('digits', true)) $pool .= '0123456789';
        if ($request->boolean('symbols')) $pool .= '!@#$%^&*()-_=+[]{};:,.<>?';
        if ($pool === '') $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $len = $data['length'];
        $bytes = random_bytes($len);
        $password = '';
        $poolLen = strlen($pool);
        for ($i = 0; $i < $len; $i++) {
            $password .= $pool[ord($bytes[$i]) % $poolLen];
        }
        $entropy = round($len * log($poolLen, 2), 1);
        $strength = $entropy < 40 ? 'Lemah' : ($entropy < 70 ? 'Sedang' : ($entropy < 100 ? 'Kuat' : 'Sangat kuat'));

        $result = ['password' => $password, 'entropy' => $entropy, 'strength' => $strength, 'pool_size' => $poolLen];

        if ($request->wantsJson()) {
            return response()->json($result);
        }

        return view('tools.pass-generator', ['result' => $result, 'length' => $len]);
    }

    /* ---------- Chmod Calculator ---------- */
    public function chmodCalc()
    {
        return view('tools.chmod-calc', ['result' => null]);
    }

    public function chmodCalculate(Request $request)
    {
        $data = $request->validate([
            'octal' => 'nullable|regex:/^[0-7]{3,4}$/',
            'symbolic' => 'nullable|string|max:11',
        ]);
        if (empty($data['octal']) && empty($data['symbolic'])) {
            return back()->withErrors(['octal' => 'Isi oktal (mis. 755) atau simbolik (mis. rwxr-xr-x).']);
        }

        if (!empty($data['octal'])) {
            $oct = ltrim($data['octal'], '0');
            $oct = str_pad($oct, 3, '0', STR_PAD_LEFT);
            $map = ['---', '--x', '-w-', '-wx', 'r--', 'r-x', 'rw-', 'rwx'];
            $symbolic = '';
            foreach (str_split(substr($oct, -3)) as $d) {
                $symbolic .= $map[(int) $d];
            }
            $result = ['octal' => $oct, 'symbolic' => $symbolic];
        } else {
            $sym = preg_replace('/[^rwx-]/', '-', strtolower($data['symbolic']));
            $sym = substr(str_pad($sym, 9, '-', STR_PAD_RIGHT), 0, 9);
            $octal = '';
            foreach (str_split($sym, 3) as $tri) {
                $v = ($tri[0] === 'r' ? 4 : 0) + ($tri[1] === 'w' ? 2 : 0) + ($tri[2] === 'x' ? 1 : 0);
                $octal .= (string) $v;
            }
            $result = ['octal' => $octal, 'symbolic' => $sym];
        }

        if ($request->wantsJson()) {
            return response()->json($result);
        }

        return view('tools.chmod-calc', ['result' => $result]);
    }

    /* ---------- Base64 Converter ---------- */
    public function base64Conv()
    {
        return view('tools.base64-conv', ['result' => null]);
    }

    public function base64Convert(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string|max:50000',
            'mode' => 'required|in:encode,decode,url_encode,url_decode,hex_encode,hex_decode',
        ]);
        $error = null;
        $output = null;
        try {
            switch ($data['mode']) {
                case 'encode':
                    $output = base64_encode($data['text']);
                    break;
                case 'decode':
                    $decoded = base64_decode($data['text'], true);
                    if ($decoded === false) throw new \InvalidArgumentException('Input bukan Base64 valid.');
                    $output = $decoded;
                    break;
                case 'url_encode':
                    $output = rtrim(strtr(base64_encode($data['text']), '+/', '-_'), '=');
                    break;
                case 'url_decode':
                    $b64 = strtr($data['text'], '-_', '+/');
                    $b64 .= str_repeat('=', (4 - strlen($b64) % 4) % 4);
                    $decoded = base64_decode($b64, true);
                    if ($decoded === false) throw new \InvalidArgumentException('Input bukan Base64 URL-safe valid.');
                    $output = $decoded;
                    break;
                case 'hex_encode':
                    $output = bin2hex($data['text']);
                    break;
                case 'hex_decode':
                    if (!ctype_xdigit($data['text']) || strlen($data['text']) % 2 !== 0) {
                        throw new \InvalidArgumentException('Input bukan hex valid.');
                    }
                    $output = hex2bin($data['text']);
                    break;
            }
        } catch (\InvalidArgumentException $e) {
            $error = $e->getMessage();
        }

        if ($request->wantsJson()) {
            return $error
                ? response()->json(['error' => $error], 422)
                : response()->json(['mode' => $data['mode'], 'output' => $output]);
        }

        if ($error) {
            return view('tools.base64-conv', ['result' => null, 'error' => $error, 'input' => $data['text']]);
        }

        return view('tools.base64-conv', ['result' => $output, 'input' => $data['text'], 'mode' => $data['mode']]);
    }

    /* ---------- Cron Parser (deskripsi Indonesia) ---------- */
    public function cronParser()
    {
        return view('tools.cron-parser', ['result' => null]);
    }

    public function cronParse(Request $request)
    {
        $data = $request->validate(['expression' => 'required|string|max:100']);
        $parts = preg_split('/\s+/', trim($data['expression']));
        if (count($parts) !== 5) {
            $error = 'Ekspresi cron harus terdiri dari 5 kolom: menit jam tanggal bulan hari.';
            if ($request->wantsJson()) return response()->json(['error' => $error], 422);

            return view('tools.cron-parser', ['result' => null, 'error' => $error, 'input' => $data['expression']]);
        }
        [$min, $hour, $dom, $mon, $dow] = $parts;
        $desc = 'Berjalan ' . $this->cronField($min, 0, 59, 'menit', 'jam')
            . ' ' . $this->cronField($hour, 0, 23, 'menit ke-:value', 'jam :value')
            . ' ' . $this->cronField($dom, 1, 31, null, 'tanggal :value')
            . ' ' . $this->cronMonth($mon)
            . ' ' . $this->cronDow($dow);
        $desc = trim(preg_replace('/\s+/', ' ', $desc));
        $result = ['expression' => $data['expression'], 'description' => ucfirst($desc) . '.', 'fields' => [
            'menit' => $min, 'jam' => $hour, 'tanggal' => $dom, 'bulan' => $mon, 'hari' => $dow,
        ]];

        if ($request->wantsJson()) {
            return response()->json($result);
        }

        return view('tools.cron-parser', ['result' => $result, 'input' => $data['expression']]);
    }

    private function cronField(string $expr, int $min, int $max, ?string $every, string $at): string
    {
        if ($expr === '*') return 'setiap ' . ($every ? explode(' ', $every)[0] : 'waktu');
        if (str_starts_with($expr, '*/')) return 'setiap ' . substr($expr, 2) . ' ' . ($every ? explode(' ', $every)[0] : 'waktu');
        if (str_contains($expr, ',')) return 'pada ' . str_replace(',', ', ', $expr);
        if (str_contains($expr, '-')) return 'antara ' . str_replace('-', ' sampai ', $expr);
        if (str_contains($expr, '/')) {
            [$range, $step] = explode('/', $expr);
            return "setiap $step mulai $range";
        }

        return str_replace(':value', $expr, $at);
    }

    private function cronMonth(string $expr): string
    {
        $names = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
        if ($expr === '*') return 'setiap bulan';
        if (str_starts_with($expr, '*/')) return 'setiap ' . substr($expr, 2) . ' bulan';
        if (isset($names[(int) $expr])) return 'bulan ' . $names[(int) $expr];

        return 'bulan ' . $expr;
    }

    private function cronDow(string $expr): string
    {
        $names = [0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        if ($expr === '*') return 'setiap hari';
        if (isset($names[(int) $expr])) return 'hari ' . $names[(int) $expr];

        return 'hari ' . $expr;
    }

    /* ---------- JSON Viewer ---------- */
    public function jsonViewer()
    {
        return view('tools.json-viewer', ['result' => null]);
    }

    public function jsonValidate(Request $request)
    {
        $data = $request->validate(['json' => 'required|string|max:200000']);
        $decoded = json_decode($data['json'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = 'JSON tidak valid: ' . json_last_error_msg();
            if ($request->wantsJson()) return response()->json(['valid' => false, 'error' => $error], 422);

            return view('tools.json-viewer', ['result' => null, 'error' => $error, 'input' => $data['json']]);
        }
        $result = ['valid' => true, 'pretty' => json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)];

        if ($request->wantsJson()) {
            return response()->json($result);
        }

        return view('tools.json-viewer', ['result' => $result, 'input' => $data['json']]);
    }

    /* ---------- Markdown Viewer (render aman) ---------- */
    public function markdownViewer()
    {
        return view('tools.markdown-viewer', ['result' => null]);
    }

    public function markdownRender(Request $request)
    {
        $data = $request->validate(['markdown' => 'required|string|max:100000']);
        $html = $this->safeMarkdown($data['markdown']);

        if ($request->wantsJson()) {
            return response()->json(['html' => $html]);
        }

        return view('tools.markdown-viewer', ['result' => $html, 'input' => $data['markdown']]);
    }

    private function safeMarkdown(string $md): string
    {
        $md = str_replace("\r\n", "\n", $md);
        // Ekstrak blok kode dulu agar isinya tidak diproses
        $blocks = [];
        $md = preg_replace_callback('/```(\w*)\n(.*?)```/s', function ($m) use (&$blocks) {
            $blocks[] = '<pre><code>' . htmlspecialchars($m[2], ENT_QUOTES, 'UTF-8') . '</code></pre>';

            return "\x00BLOCK" . (count($blocks) - 1) . "\x00";
        }, $md);

        $lines = explode("\n", $md);
        $out = [];
        $inList = false;
        foreach ($lines as $line) {
            $t = trim($line);
            if (preg_match('/^\x00BLOCK\d+\x00$/', $t)) {
                if ($inList) { $out[] = '</ul>'; $inList = false; }
                $out[] = $t;
                continue;
            }
            if (preg_match('/^#{1,6}\s+(.*)$/', $t, $m)) {
                if ($inList) { $out[] = '</ul>'; $inList = false; }
                $level = strlen(explode(' ', $t)[0]);
                $level = min($level, 6);
                $out[] = "<h$level>" . $this->inlineMd($m[1]) . "</h$level>";
            } elseif (preg_match('/^---+$|^___+$|^\*\*\*+$/', $t)) {
                if ($inList) { $out[] = '</ul>'; $inList = false; }
                $out[] = '<hr>';
            } elseif (preg_match('/^&gt;|^>/', $t)) {
                if ($inList) { $out[] = '</ul>'; $inList = false; }
                $out[] = '<blockquote>' . $this->inlineMd(ltrim($t, '> ')) . '</blockquote>';
            } elseif (preg_match('/^[-*+]\s+(.*)$/', $t, $m)) {
                if (!$inList) { $out[] = '<ul>'; $inList = true; }
                $out[] = '<li>' . $this->inlineMd($m[1]) . '</li>';
            } elseif ($t === '') {
                if ($inList) { $out[] = '</ul>'; $inList = false; }
            } else {
                if ($inList) { $out[] = '</ul>'; $inList = false; }
                $out[] = '<p>' . $this->inlineMd($t) . '</p>';
            }
        }
        if ($inList) $out[] = '</ul>';
        $html = implode("\n", $out);

        return preg_replace_callback('/\x00BLOCK(\d+)\x00/', fn ($m) => $blocks[(int) $m[1]], $html);
    }

    private function inlineMd(string $text): string
    {
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        // link [teks](https://...) — hanya http/https
        $text = preg_replace_callback('/\[([^\]]+)\]\(([^)]+)\)/', function ($m) {
            $url = htmlspecialchars_decode($m[2], ENT_QUOTES);
            if (!preg_match('#^https?://#i', trim($url))) {
                return $m[1]; // tolak skema berbahaya (javascript:, data:)
            }
            $safe = htmlspecialchars(trim($url), ENT_QUOTES, 'UTF-8');

            return '<a href="' . $safe . '" rel="noopener noreferrer" target="_blank">' . $m[1] . '</a>';
        }, $text);
        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
        $text = preg_replace('/(?<!\*)\*(?!\*)(.+?)(?<!\*)\*(?!\*)/s', '<em>$1</em>', $text);
        $text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $text);

        return $text;
    }
}
