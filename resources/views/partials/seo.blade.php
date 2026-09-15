@php
    // Defaults — override per-page via @include('partials.seo', [...]) or @section()
    $seoTitle = $seoTitle ?? ($title ?? 'Risky Setiawan — Cyber Security Analyst & DevOps Enthusiast | Cirebon, Indonesia');
    $seoDescription = $seoDescription ?? ($description ?? 'Portfolio Risky Setiawan: Cyber Security Analyst & Information Security Analyst RS Pasar Minggu Cirebon, Indonesia. Spesialis cybersecurity, vulnerability assessment, threat analysis & network defense. S1 Informatika UM Cirebon. Hubungi 082320224745.');
    $seoKeywords = $seoKeywords ?? ($keywords ?? 'Risky Setiawan, Cyber Security Analyst, cybersecurity, vulnerability assessment, Penetration Testing, SOC, Cirebon, Indramayu, Jawa Barat, DevOps, Laravel, Docker, Mindset Digital, Neura Terra, portfolio');
    $seoCanonical = $seoCanonical ?? ($canonical ?? rtrim(config('app.url'), '/') . '/' . ltrim(request()->path() === '/' ? '' : request()->path(), '/'));
    $seoRobots = $seoRobots ?? ($robots ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1');
    $seoAuthor = $seoAuthor ?? 'Risky Setiawan';
    $seoLocale = app()->getLocale() === 'id' ? 'id_ID' : 'en_US';
    $seoImage = $seoImage ?? rtrim(config('app.url'), '/') . '/images/profile.jpg';
    $seoType = $seoType ?? 'profile'; // profile for personal portfolio, website fallback handled below
@endphp

{{-- ========== PRIMARY META ========== --}}
<title>{{ $seoTitle }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="author" content="{{ $seoAuthor }}">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="googlebot" content="index, follow, max-image-preview:large">
<meta name="bingbot" content="index, follow">
<meta name="revisit-after" content="7 days">
<meta name="rating" content="general">
<meta name="referrer" content="strict-origin-when-cross-origin">
<meta name="color-scheme" content="dark light">
<meta name="theme-color" media="(prefers-color-scheme: light)" content="#FDFDFC">
<meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0a0a0a">
<meta name="generator" content="Laravel {{ app()->version() }}">
<meta name="application-name" content="Risky Setiawan Portfolio">

{{-- ========== CANONICAL + HREFLANG (id/en) ========== --}}
<link rel="canonical" href="{{ $seoCanonical }}">
<link rel="alternate" hreflang="id" href="{{ $seoCanonical }}">
<link rel="alternate" hreflang="en" href="{{ $seoCanonical }}">
<link rel="alternate" hreflang="x-default" href="{{ $seoCanonical }}">

{{-- ========== GEO TAGS — Cirebon, ID ========== --}}
<meta name="geo.region" content="ID-JB">
<meta name="geo.placename" content="Cirebon, Jawa Barat, Indonesia">
<meta name="geo.position" content="-6.7320;108.5523">
<meta name="ICBM" content="-6.7320, 108.5523">
<meta name="coverage" content="Indonesia">
<meta name="distribution" content="global">
<meta name="target" content="all">

{{-- ========== OPEN GRAPH ========== --}}
<meta property="og:type" content="profile">
<meta property="og:site_name" content="Risky Setiawan Portfolio">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:image:alt" content="Foto profil Risky Setiawan — Cyber Security Analyst, Cirebon Indonesia">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="{{ $seoLocale }}">
<meta property="og:locale:alternate" content="{{ $seoLocale === 'id_ID' ? 'en_US' : 'id_ID' }}">
<meta property="profile:first_name" content="Risky">
<meta property="profile:last_name" content="Setiawan">
<meta property="profile:username" content="setiawan-risky">

{{-- ========== TWITTER CARDS ========== --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@riskysetiawan">
<meta name="twitter:creator" content="@riskysetiawan">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
<meta name="twitter:image:alt" content="Foto profil Risky Setiawan — Cyber Security Analyst, Cirebon Indonesia">

{{-- ========== LINKEDIN / MESSAGING PREVIEW ========== --}}
<meta property="article:author" content="https://www.linkedin.com/in/setiawan-risky">

{{-- ========== FAVICON + PWA ========== --}}
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="Risky Setiawan">

{{-- ========== PERFORMANCE HINTS ========== --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://www.google-analytics.com">

{{-- ========== VERIFICATION PLACEHOLDERS (isi saat domain live) ========== --}}
{{-- <meta name="google-site-verification" content="PASTE_TOKEN"> --}}
{{-- <meta name="msvalidate.01" content="PASTE_TOKEN"> --}}
{{-- <meta name="yandex-verification" content="PASTE_TOKEN"> --}}

{{-- ========== JSON-LD: Person + WebSite + BreadcrumbList ========== --}}
@php
    $baseUrl = rtrim(config('app.url'), '/');
    $personSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        '@id' => $baseUrl . '/#person',
        'name' => 'Risky Setiawan',
        'alternateName' => 'Setiawan Risky',
        'url' => $baseUrl . '/',
        'image' => $seoImage,
        'description' => $seoDescription,
        'birthDate' => '2001-08-10',
        'birthPlace' => ['@type' => 'Place', 'name' => 'Indramayu, Jawa Barat, Indonesia'],
        'nationality' => 'Indonesian',
        'jobTitle' => 'Cyber Security Analyst & DevOps Enthusiast',
        'worksFor' => [
            ['@type' => 'Organization', '@id' => $baseUrl . '/#org-mindset', 'name' => 'Mindset Digital', 'jobTitle' => 'Chief Technology Officer'],
            ['@type' => 'Organization', '@id' => $baseUrl . '/#org-neura', 'name' => 'Neura Terra', 'jobTitle' => 'Tech Lead'],
            ['@type' => 'Organization', '@id' => $baseUrl . '/#org-rspm', 'name' => 'RS Pasar Minggu', 'jobTitle' => 'Security Analyst'],
        ],
        'alumniOf' => ['@type' => 'CollegeOrUniversity', 'name' => 'Universitas Muhammadiyah Cirebon', 'sameAs' => 'https://umc.ac.id'],
        'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Cirebon', 'addressRegion' => 'Jawa Barat', 'addressCountry' => 'ID'],
        'email' => 'mailto:setiawanriski23@outlook.com',
        'telephone' => '+62-823-2022-4745',
        'knowsAbout' => ['Cyber Security', 'Cybersecurity', 'Vulnerability Assessment', 'Penetration Testing', 'SOC Monitoring', 'DevOps', 'Docker', 'CI/CD', 'Laravel', 'Linux Hardening', 'Network Security'],
        'sameAs' => [
            'https://www.linkedin.com/in/setiawan-risky',
            'https://github.com/sinnersman',
            'https://setiawandev.my.id',
        ],
    ];
    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => $baseUrl . '/#website',
        'url' => $baseUrl . '/',
        'name' => 'Risky Setiawan Portfolio',
        'description' => $seoDescription,
        'author' => ['@id' => $baseUrl . '/#person'],
        'inLanguage' => ['id-ID', 'en-US'],
        'copyrightYear' => date('Y'),
    ];
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => $baseUrl . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang', 'item' => $baseUrl . '/#tentang'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Pengalaman', 'item' => $baseUrl . '/#pengalaman'],
            ['@type' => 'ListItem', 'position' => 4, 'name' => 'Kontak', 'item' => $baseUrl . '/#kontak'],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($personSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
<script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
