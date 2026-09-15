{{-- Hero: photo + name + tagline --}}
<section class="border-b border-slate-200 bg-slate-50">
    <div class="mx-auto flex max-w-6xl flex-col items-center gap-8 px-4 py-14 sm:px-6 md:flex-row md:gap-12 md:py-20">
        <div class="reveal shrink-0" data-reveal-delay="0">
            <img src="{{ asset($data['profile']['photo']) }}" alt="Portrait of {{ $data['profile']['name'] }}"
                class="h-44 w-44 rounded-2xl border-4 border-white object-cover shadow-md md:h-56 md:w-56" width="224" height="224">
        </div>
        <div class="reveal text-center md:text-left" data-reveal-delay="120">
            <p class="inline-flex items-center gap-1.5 rounded-full border border-brand bg-brand-soft px-3 py-1 text-xs font-semibold text-brand-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                Cyber Security Analyst
            </p>
            <p class="mt-2 inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                <span class="badge-pulse h-2 w-2 rounded-full bg-emerald-500"></span>
                Open to freelance &amp; remote work
            </p>
            <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-slate-900 md:text-5xl">{{ $data['profile']['name'] }}</h1>
            <p class="mt-2 text-xl font-semibold text-brand">{{ $data['profile']['tagline'] }}</p>
            <p class="mt-3 max-w-xl text-base leading-relaxed text-slate-600">Focused on threat analysis, vulnerability assessment, and network defense — safeguarding hospital systems and public-sector data in Cirebon, Indonesia.</p>
            <div class="mt-3 flex flex-wrap justify-center gap-2 md:justify-start">
                @foreach ($data['profile']['roles'] as $role)
                    <span class="rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold text-brand-dark">{{ $role }}</span>
                @endforeach
            </div>
            <p class="mt-4 flex items-center justify-center gap-1.5 text-sm text-slate-500 md:justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                {{ $data['profile']['location'] }}
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-3 md:justify-start">
                <a href="#contact" class="rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark">Hire Me</a>
                <a href="{{ $data['profile']['linkedin'] }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-brand hover:text-brand">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4V8h4v2a6 6 0 0 1 2-2z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    LinkedIn
                </a>
            </div>
        </div>
    </div>
</section>
