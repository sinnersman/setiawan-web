<?php

return [

    'profile' => [
        'name'     => 'Risky Setiawan',
        'tagline'  => 'Cyber Security Analyst & DevOps Engineer',
        'roles'    => ['Cyber Security Analyst', 'Laravel Developer', 'DevOps Engineer'],
        'location' => 'Cirebon, Indonesia · Available for Remote Work',
        'email'    => 'setiawanriski23@hotmail.com',
        'linkedin' => 'https://linkedin.com/in/setiawan-risky',
        'photo'    => 'images/profile.jpg',
        'summary'  => 'Versatile professional combining web development (Laravel, Python), '
            . 'cybersecurity (penetration testing, SDLC, firewalls), and server automation '
            . '(DevOps, Bash, Git). Experienced in NAT-based data center architecture, '
            . 'automation bots, monitoring systems, and high-availability infrastructure. '
            . 'Open to freelance and remote-based opportunities.',
    ],

    /*
    | Timeline entries shown newest-first. `type` is one of: work | project | education.
    | `period` is optional — entries without a confirmed period render without a date
    | rather than a guessed one. Update periods here once confirmed.
    */
    'timeline' => [
        [
            'type' => 'work',
            'title' => 'Technical Lead',
            'organization' => 'PT Neura Terra Technologies',
            'period' => null,
            'description' => 'Lead engineering and infrastructure delivery: distributed storage clusters, '
                . 'data center redesign, and AI-powered monitoring systems for regional government.',
        ],
        [
            'type' => 'work',
            'title' => 'Chief Technology Officer',
            'organization' => 'PT Mindset Digital Corp',
            'period' => null,
            'description' => 'Own technology strategy and product engineering, including the patented '
                . 'hospital information system (SIMRS) and integrated medical operations platform.',
        ],
        [
            'type' => 'work',
            'title' => 'Information Security Analyst',
            'organization' => 'RS Pasar Minggu Cirebon',
            'period' => null,
            'description' => 'Secure hospital IT systems: vulnerability assessment, network auditing, '
                . 'firewall policy, and risk mitigation for critical healthcare infrastructure.',
        ],
        [
            'type' => 'work',
            'title' => 'Software Programmer',
            'organization' => 'CV Harjuan Engineering',
            'period' => null,
            'description' => 'Build and maintain web applications and REST API integrations on '
                . 'Laravel-based stacks.',
        ],
        [
            'type' => 'project',
            'title' => 'Distributed S3 Storage Cluster',
            'organization' => 'cdn.cirebonkab.go.id · Garage S3',
            'period' => null,
            'description' => 'Designed a replicated, high-availability object-storage cluster serving '
                . 'as an independent local CDN for Cirebon regional government digital assets.',
        ],
        [
            'type' => 'project',
            'title' => 'Data Center & Regional Network Redesign',
            'organization' => 'Diskominfo Kabupaten Cirebon · Proxmox, Docker Swarm',
            'period' => null,
            'description' => 'Rebuilt the server cluster on Proxmox virtualization with Docker Swarm '
                . 'orchestration; audited and hardened the regional network perimeter and bandwidth controls.',
        ],
        [
            'type' => 'project',
            'title' => 'AI CCTV Traffic Monitoring',
            'organization' => 'YOLO Computer Vision',
            'period' => null,
            'description' => 'Built a 24/7 intelligent detection cluster using YOLO on live CCTV streams '
                . 'for automatic heavy-vehicle detection and load-tonnage estimation.',
        ],
        [
            'type' => 'project',
            'title' => 'DatasetSync Executive Dashboard',
            'organization' => 'Kabupaten Cirebon · Full-Stack & API',
            'period' => null,
            'description' => 'Developed an integrated data-synchronization system with a secure backend '
                . 'and an interactive executive analytics dashboard for data-driven policy making.',
        ],
        [
            'type' => 'project',
            'title' => 'Multitenant Web CMS',
            'organization' => 'SaaS · Information Security',
            'period' => null,
            'description' => 'Architected an enterprise multi-tenant SaaS CMS with database isolation, '
                . 'strict access control, and industry-standard cryptographic protocols.',
        ],
        [
            'type' => 'education',
            'title' => "Bachelor's Degree in Informatics Engineering",
            'organization' => 'Universitas Muhammadiyah Cirebon',
            'period' => null,
            'description' => 'Undergraduate foundation in software engineering, networks, and information systems.',
        ],
    ],

    'skills' => [
        [
            'group' => 'Infrastructure & DevOps',
            'items' => ['Linux Server', 'Proxmox', 'Docker Swarm', 'Garage S3', 'PPPoE Management', 'Bash & Cron', 'Git', 'GCP', 'AWS'],
        ],
        [
            'group' => 'Cybersecurity',
            'items' => ['Penetration Testing', 'Vulnerability Assessment', 'Network Auditing', 'Firewalls', 'SDLC', 'Cryptographic Protocols', 'Risk Mitigation', 'DNS & Network Security'],
        ],
        [
            'group' => 'Software Development',
            'items' => ['Laravel', 'Python', 'Flask', 'CodeIgniter', 'REST API', 'SQL', 'Multi-tenant SaaS', 'YOLO Object Detection'],
        ],
        [
            'group' => 'Hardware & IoT',
            'items' => ['Arduino', 'Smart PJU', 'Smart Coffee IoT Monitoring'],
        ],
    ],

    'education' => [
        'degree' => "Bachelor's Degree in Informatics Engineering",
        'school' => 'Universitas Muhammadiyah Cirebon',
        'note'   => 'Focused on software engineering, computer networks, and information systems.',
    ],

    'publications' => [
        [
            'title' => 'Hospital Information System (SIMRS) — Mindset Technology',
            'kind'  => 'Patent',
            'detail' => 'Integrated medical operations system patent.',
        ],
        [
            'title' => 'Smart PJU Street-Lighting System',
            'kind'  => 'Exhibition',
            'detail' => 'Selected IoT technology, exhibited at national tech exhibition Cinofest 2025.',
        ],
        [
            'title' => 'IoT-based Smart Coffee System for Gunungmanik Farmers',
            'kind'  => 'Publication',
            'detail' => 'Development and mentoring of automatic coffee monitoring for farmers in Gunungmanik, West Java (PDUPT / PKM village grant).',
        ],
    ],

];
