<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    {{-- SEO: title, meta, OG, Twitter, JSON-LD, hreflang, geo --}}
    @include('partials.seo')

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-white font-sans text-slate-900 antialiased">

    {{-- Top navigation --}}
    <header id="site-header" class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6" aria-label="Main navigation">
            <a href="/#top" class="flex items-center gap-2 font-bold tracking-tight">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand text-sm font-extrabold text-white">RS</span>
                <span class="hidden sm:inline">Risky Setiawan</span>
            </a>
            <div class="hidden items-center gap-1 text-sm font-medium text-slate-600 md:flex">
                <a href="/#about" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">About</a>
                <a href="/#experience" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">Experience</a>
                <a href="/#skills" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">Skills</a>
                <a href="/#security-projects" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">Security Research</a>
                <a href="/#education" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">Education</a>
                <a href="/#publications" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">Publications</a>
                <a href="/tools" class="rounded-md px-3 py-2 hover:bg-slate-100 hover:text-slate-900">Tools</a>
            </div>
            <a href="/#contact" class="rounded-lg bg-brand px-4 py-2 text-sm font-semibold text-white transition hover:bg-brand-dark">Contact</a>
        </nav>
        {{-- Mobile section links --}}
        <nav class="flex gap-1 overflow-x-auto border-t border-slate-100 px-4 py-2 text-sm font-medium text-slate-600 md:hidden" aria-label="Sections">
            <a href="/#about" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">About</a>
            <a href="/#experience" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">Experience</a>
            <a href="/#skills" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">Skills</a>
            <a href="/#security-projects" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">Security Research</a>
            <a href="/#education" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">Education</a>
            <a href="/#publications" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">Publications</a>
            <a href="/tools" class="whitespace-nowrap rounded-md px-3 py-1.5 hover:bg-slate-100">Tools</a>
        </nav>
    </header>

    <main id="top" class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-slate-50">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-3 px-4 py-8 text-sm text-slate-500 sm:flex-row sm:px-6">
            <p>&copy; {{ date('Y') }} Risky Setiawan. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <a href="{{ $data['profile']['whatsapp'] ?? '#' }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 hover:text-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/></svg>
                    WhatsApp
                </a>
                <a href="{{ $data['profile']['linkedin'] ?? '#' }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 hover:text-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4V8h4v2a6 6 0 0 1 2-2z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    LinkedIn
                </a>
                <a href="mailto:{{ $data['profile']['email'] ?? '' }}" class="inline-flex items-center gap-1.5 hover:text-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    Email
                </a>
            </div>
        </div>
    </footer>

    @include('components.toast')

</body>
</html>
