{{-- Security Research: defensive security projects on GitHub --}}
<section id="security-projects" class="scroll-mt-24 border-b border-slate-200 bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 md:py-18">
        <div class="reveal max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">Security Research</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Defensive Security Projects</h2>
            <p class="mt-4 leading-relaxed text-slate-600">Public research and tooling I maintain to understand attacker techniques so I can defend better — vulnerability analysis, detection, and exposure mapping for the systems I protect. All work is lab-based and defensive.</p>
        </div>
        <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @php
                $securityProjects = [
                    [
                        'name' => 'CVE-2026-3888 PoC',
                        'url' => 'https://github.com/sinnersman/CVE-2026-3888-POC',
                        'language' => 'Python',
                        'description' => 'Lab reproduction of a Qualys-disclosed snapd race-condition flaw — used to validate exposure and verify patching on test systems, never against third parties.',
                        'tags' => ['Vulnerability Research', 'Patch Validation'],
                    ],
                    [
                        'name' => 'SSL Pinning Bypass Lab',
                        'url' => 'https://github.com/sinnersman/SSL-pinning-bypass',
                        'language' => 'JavaScript',
                        'description' => 'Frida lab notes for auditing TLS protections in my own mobile test apps — learning how pinning can fail so I can recommend stronger mobile transport security.',
                        'tags' => ['Mobile Security', 'TLS Audit'],
                    ],
                    [
                        'name' => 'XSS Hunter (self-hosted)',
                        'url' => 'https://github.com/sinnersman/xsshunter-express',
                        'language' => 'JavaScript',
                        'description' => 'Self-hosted blind-XSS callback collector on Express — detects stored XSS in web assets I am authorized to assess, so flaws get fixed before attackers find them.',
                        'tags' => ['XSS Detection', 'Web Security'],
                    ],
                    [
                        'name' => 'ffuf Web Fuzzer',
                        'url' => 'https://github.com/sinnersman/ffuf',
                        'language' => 'Go',
                        'description' => 'Fast Go-based web fuzzer I use in authorized assessments to enumerate my own attack surface — hidden endpoints and misconfigurations found early get hardened early.',
                        'tags' => ['Fuzzing', 'Attack-Surface Audit'],
                    ],
                    [
                        'name' => 'GoDNS Project',
                        'url' => 'https://github.com/sinnersman/GoDNS-Project',
                        'language' => 'Go',
                        'description' => 'DNS enumeration and OSINT toolkit in Go — maps DNS exposure and asset inventory so forgotten subdomains and records can be secured.',
                        'tags' => ['OSINT', 'DNS Recon'],
                    ],
                    [
                        'name' => 'GoDork',
                        'url' => 'https://github.com/sinnersman/GoDork',
                        'language' => 'Go',
                        'description' => 'Google-dork scanner for defensive reconnaissance — finds unintentionally exposed documents and endpoints of my own organization so they can be taken down.',
                        'tags' => ['OSINT', 'Exposure Mapping'],
                    ],
                    [
                        'name' => 'wpdecrypt',
                        'url' => 'https://github.com/sinnersman/wpdecrypt',
                        'language' => 'PHP',
                        'description' => 'WordPress hash and obfuscated-code analysis lab — supports password-hygiene auditing and malware triage on WordPress sites I administer.',
                        'tags' => ['WordPress', 'Password Audit'],
                    ],
                    [
                        'name' => 'Burp Suite Notes',
                        'url' => 'https://github.com/sinnersman/Burp-Suite',
                        'language' => 'Methodology',
                        'description' => 'Web security testing methodology notes around Burp Suite — structured approach to auditing my own applications for OWASP Top 10 issues.',
                        'tags' => ['Burp Suite', 'Web Audit'],
                    ],
                ];
            @endphp
            @foreach ($securityProjects as $project)
                <article class="reveal card-lift flex flex-col rounded-xl border border-slate-200 bg-white p-6 shadow-sm" data-reveal-delay="{{ min($loop->index * 70, 420) }}">
                    <div class="flex items-center justify-between gap-2">
                        <h3 class="font-bold text-slate-900">{{ $project['name'] }}</h3>
                        <span class="shrink-0 rounded-full bg-brand-soft px-2.5 py-1 text-xs font-semibold text-brand-dark">{{ $project['language'] }}</span>
                    </div>
                    <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $project['description'] }}</p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($project['tags'] as $tag)
                            <span class="rounded-full border border-slate-200 bg-slate-50 px-2.5 py-1 text-xs font-medium text-slate-600">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener"
                        class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
                        View on GitHub
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
