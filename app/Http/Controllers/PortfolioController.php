<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    private function dataProfile(): array
    {
        return [
            'name' => 'Risky Setiawan',
            'tagline' => 'Cyber Security Analyst · Information Security Analyst · Technical Lead',
            'birth' => 'Indramayu, 10 August 2001',
            'location' => 'Cirebon, West Java, Indonesia',
            'phone' => '082320224745',
            'email' => 'setiawanriski23@outlook.com',
            'linkedin' => 'https://linkedin.com/in/setiawan-risky',
            'photo' => 'images/profile.png',
            'summary' => 'Cyber Security Analyst and Information Security Analyst at RS Pasar Minggu Cirebon, focused on threat analysis, vulnerability assessment, and network defense for hospital information systems. Also serving as Technical Lead at PT Neura Terra Technologies and CTO at PT Mindset Digital Corp, with a security-first approach across SIMRS, fintech, and IoT work.',
            'socials' => [
                'linkedin' => 'https://linkedin.com/in/setiawan-risky',
                'github' => 'https://github.com/sinnersman',
                'blog' => 'https://setiawandev.my.id',
            ],
        ];
    }

    private function dataExperiences(): array
    {
        return [
            [
                'role' => 'Technical Lead',
                'company' => 'PT Neura Terra Technologies',
                'period' => 'Jan 2025 – Present',
                'description' => 'Leading engineering delivery, architecture decisions, and code quality across company projects.',
            ],
            [
                'role' => 'Information Security Analyst',
                'company' => 'RS Pasar Minggu Cirebon',
                'period' => 'Nov 2024 – Present',
                'description' => 'Hospital IT security: hardening, vulnerability assessment, and security best-practice enforcement for clinical systems.',
            ],
            [
                'role' => 'Chief Technology Officer',
                'company' => 'PT Mindset Digital Corp',
                'period' => 'Dec 2023 – Present',
                'description' => 'Technology strategy and product development, including SIMRS Mindset Technology (patented hospital management system).',
            ],
            [
                'role' => 'Software Programmer',
                'company' => 'PT Bengkel Web',
                'period' => '2023 – 2024',
                'description' => 'Web application development for client projects across company profiles, e-commerce, and custom systems.',
            ],
            [
                'role' => 'Software Programmer',
                'company' => 'CV Hanjuan Engineering',
                'period' => '2023 – 2024',
                'description' => 'Engineering software solutions and internal tooling.',
            ],
            [
                'role' => 'Researcher — PDUPT Smart Coffee IoT',
                'company' => 'Penelitian Dasar Unggulan Perguruan Tinggi (PDUPT) 2021',
                'period' => '2021 – 2022',
                'description' => 'IoT-based smart coffee monitoring research; published work on coffee cultivation in Gunungmanik.',
            ],
            [
                'role' => 'PKM Team Member',
                'company' => 'Program Kreativitas Mahasiswa (PKM) 2022',
                'period' => '2022',
                'description' => 'Student creativity program project — applied technology for community impact.',
            ],
            [
                'role' => 'Developer — SiPIPIT',
                'company' => 'RS Paru Sidawangi',
                'period' => '2022 – 2023',
                'description' => 'Developed SiPIPIT hospital information application for pulmonary hospital operations.',
            ],
            [
                'role' => 'Programmer',
                'company' => 'BRI Syariah',
                'period' => '2018',
                'description' => 'Programming support for sharia banking operations and internal systems.',
            ],
            [
                'role' => 'Independent IoT Researcher',
                'company' => 'Smart Coffee Monitoring — Gunungmanik',
                'period' => '2021 – Present',
                'description' => 'Ongoing IoT research on sensor-based coffee crop monitoring; basis of published paper.',
            ],
        ];
    }

    private function dataEducation(): array
    {
        return [
            [
                'degree' => 'S1 Informatika (Bachelor of Informatics)',
                'school' => 'Universitas Muhammadiyah Cirebon',
                'period' => '2019 – 2023',
                'description' => 'Undergraduate informatics program; research focus on IoT and smart agriculture.',
            ],
        ];
    }

    private function dataSkills(): array
    {
        return [
            'Vulnerability Assessment',
            'Burp Suite',
            'Web Fuzzing (ffuf)',
            'XSS Testing',
            'OSINT & Google Dorking',
            'SSL/TLS Analysis',
            'Linux Hardening',
            'Network Administration',
            'IT Security Best Practices',
            'PHP / Laravel',
            'Hospital Information Systems (SIMRS)',
            'MySQL / Database Design',
            'Git / Team Leadership',
        ];
    }

    private function dataPublications(): array
    {
        return [
            [
                'title' => 'IoT-Based Smart Coffee Monitoring in Gunungmanik',
                'venue' => 'PDUPT Research Publication, 2021–2022',
                'description' => 'Sensor-driven monitoring system for coffee cultivation; research output of the PDUPT Smart Coffee IoT grant.',
            ],
        ];
    }

    private function dataPatents(): array
    {
        return [
            [
                'title' => 'SIMRS Mindset Technology',
                'holder' => 'PT Mindset Digital Corp',
                'description' => 'Patented hospital management information system (Sistem Informasi Manajemen Rumah Sakit).',
            ],
        ];
    }

    private function dataProjects(): array
    {
        return [
            [
                'name' => 'SIMRS Mindset Technology',
                'org' => 'PT Mindset Digital Corp',
                'description' => 'Patented hospital management information system covering patient administration, medical records, and reporting.',
                'tags' => ['Laravel', 'SIMRS', 'Patent'],
            ],
            [
                'name' => 'SiPIPIT',
                'org' => 'RS Paru Sidawangi',
                'description' => 'Hospital information application supporting pulmonary hospital workflows.',
                'tags' => ['Web App', 'Healthcare'],
            ],
            [
                'name' => 'Smart Coffee IoT',
                'org' => 'PDUPT 2021 Research',
                'description' => 'IoT sensor network for coffee crop monitoring in Gunungmanik, with published research output.',
                'tags' => ['IoT', 'Research', 'Publication'],
            ],
            [
                'name' => 'BRI Syariah Internal Systems',
                'org' => 'BRI Syariah',
                'description' => 'Programming support for sharia banking operations (2018).',
                'tags' => ['Fintech', 'Banking'],
            ],
            [
                'name' => 'Neura Terra Platform Work',
                'org' => 'PT Neura Terra Technologies',
                'description' => 'Technical leadership across engineering delivery as Technical Lead.',
                'tags' => ['Leadership', 'Architecture'],
            ],
            [
                'name' => 'This Portfolio Website',
                'org' => 'Personal',
                'description' => 'Laravel 13 portfolio site served from XAMPP, with contact pipeline and toast notifications.',
                'tags' => ['Laravel 13', 'Blade'],
            ],
        ];
    }

    private function dataGithub(): array
    {
        return [
            'username' => 'sinnersman',
            'url' => 'https://github.com/sinnersman',
            'public_repos' => 56,
            'blog' => 'https://setiawandev.my.id',
        ];
    }

    private function dataGithubProjects(): array
    {
        return [
            [
                'name' => 'sso-decoder',
                'language' => 'PHP',
                'description' => 'Utility decoder for inspecting and debugging SSO token payloads.',
                'url' => 'https://github.com/sinnersman/sso-decoder',
            ],
            [
                'name' => 'Decode-Helper',
                'language' => 'PHP',
                'description' => 'Helper toolkit for decoding common obfuscated and encoded payloads.',
                'url' => 'https://github.com/sinnersman/Decode-Helper',
            ],
            [
                'name' => 'xsshunter-express',
                'language' => 'JavaScript',
                'description' => 'Self-hosted blind-XSS callback collector built on Express.',
                'url' => 'https://github.com/sinnersman/xsshunter-express',
            ],
            [
                'name' => 'GoDNS-Project',
                'language' => 'Go',
                'description' => 'DNS enumeration and reconnaissance toolkit written in Go.',
                'url' => 'https://github.com/sinnersman/GoDNS-Project',
            ],
            [
                'name' => 'GoDork',
                'language' => 'Go',
                'description' => 'Fast Google-dork scanner for security reconnaissance workflows.',
                'url' => 'https://github.com/sinnersman/GoDork',
            ],
            [
                'name' => 'wa-api',
                'language' => 'JavaScript',
                'description' => 'WhatsApp API integration service for automated messaging.',
                'url' => 'https://github.com/sinnersman/wa-api',
            ],
            [
                'name' => 'SIAKSMP',
                'language' => 'PHP',
                'description' => 'Academic information system (SIAK) for junior high school administration.',
                'url' => 'https://github.com/sinnersman/SIAKSMP',
            ],
            [
                'name' => 'url-shortener',
                'language' => 'PHP',
                'description' => 'Minimal self-hosted URL shortener with click tracking.',
                'url' => 'https://github.com/sinnersman/url-shortener',
            ],
            [
                'name' => 'wpdecrypt',
                'language' => 'PHP',
                'description' => 'WordPress utility for analyzing encrypted or obfuscated code.',
                'url' => 'https://github.com/sinnersman/wpdecrypt',
            ],
            [
                'name' => 'CVE-2026-3888-POC',
                'language' => 'Python',
                'description' => 'Proof-of-concept exploit code for CVE-2026-3888 research.',
                'url' => 'https://github.com/sinnersman/CVE-2026-3888-POC',
            ],
            [
                'name' => 'SSL-pinning-bypass',
                'language' => 'JavaScript',
                'description' => 'Frida-based scripts for bypassing SSL pinning in mobile apps.',
                'url' => 'https://github.com/sinnersman/SSL-pinning-bypass',
            ],
            [
                'name' => 'cek-rekening',
                'language' => 'PHP',
                'description' => 'Tool for checking Indonesian bank account holder details.',
                'url' => 'https://github.com/sinnersman/cek-rekening',
            ],
        ];
    }

    private function shared(): array
    {
        return [
            'profile' => $this->dataProfile(),
            'experiences' => $this->dataExperiences(),
            'education' => $this->dataEducation(),
            'skills' => $this->dataSkills(),
            'publications' => $this->dataPublications(),
            'patents' => $this->dataPatents(),
            'projects' => $this->dataProjects(),
            'github' => $this->dataGithub(),
            'githubProjects' => $this->dataGithubProjects(),
            'data' => $this->singlePageData(),
        ];
    }

    /**
     * Adapter shaping the canonical arrays above into the $data contract
     * consumed by resources/views/sections/*.blade.php (single-page home).
     */
    private function singlePageData(): array
    {
        $profile = $this->dataProfile();

        $timeline = [];
        foreach ($this->dataExperiences() as $i => $exp) {
            $timeline[] = [
                'title' => $exp['role'],
                'organization' => $exp['company'],
                'period' => $exp['period'],
                'type' => $i < 5 ? 'work' : 'project',
                'description' => $exp['description'],
            ];
        }

        $skillGroups = [
            ['group' => 'Security', 'items' => []],
            ['group' => 'Development', 'items' => []],
        ];
        foreach ($this->dataSkills() as $i => $skill) {
            $skillGroups[$i < 8 ? 0 : 1]['items'][] = $skill;
        }

        $edu = $this->dataEducation()[0];
        $pubs = [];
        foreach ($this->dataPublications() as $pub) {
            $pubs[] = ['kind' => 'Publication', 'title' => $pub['title'], 'detail' => $pub['venue'] . ' — ' . $pub['description']];
        }
        foreach ($this->dataPatents() as $pat) {
            $pubs[] = ['kind' => 'Patent', 'title' => $pat['title'], 'detail' => $pat['holder'] . ' — ' . $pat['description']];
        }

        return [
            'profile' => array_merge($profile, [
                'roles' => ['Cyber Security Analyst', 'Information Security Analyst', 'Technical Lead'],
            ]),
            'timeline' => $timeline,
            'skills' => $skillGroups,
            'education' => [
                'degree' => $edu['degree'],
                'school' => $edu['school'],
                'note' => $edu['description'],
            ],
            'publications' => $pubs,
            'github' => $this->dataGithub(),
            'githubProjects' => $this->dataGithubProjects(),
        ];
    }

    public function home(): View
    {
        return view('home', $this->shared());
    }

    public function about(): View
    {
        return view('about', $this->shared());
    }

    public function experience(): View
    {
        return view('experience', $this->shared());
    }

    public function projects(): View
    {
        return view('projects', $this->shared());
    }

    public function contact(): View
    {
        return view('contact', $this->shared());
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:5000',
        ]);

        $payload = array_merge($validated, [
            'ip' => $request->ip(),
            'sent_at' => now()->toDateTimeString(),
        ]);

        $filename = 'contact-' . now()->format('Ymd-His') . '-' . uniqid() . '.json';
        Storage::disk('local')->put('contact-messages/' . $filename, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('contact')->with('toast', [
            'type' => 'success',
            'title' => 'Pesan terkirim',
            'message' => 'Terima kasih, ' . $validated['name'] . '! Pesan Anda berhasil terkirim.',
        ]);
    }
}
