{{-- Skills badges grouped by domain --}}
<section id="skills" class="scroll-mt-24 border-b border-slate-200">
    <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 md:py-18">
        <div class="reveal max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">Stack</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Skills &amp; Technologies</h2>
        </div>
        <div class="mt-8 grid gap-5 md:grid-cols-2">
            @foreach ($data['skills'] as $group)
                <div class="reveal card-lift rounded-xl border border-slate-200 bg-white p-6 shadow-sm" data-reveal-delay="{{ min($loop->index * 80, 400) }}">
                    <h3 class="flex items-center gap-2 font-bold text-slate-900">
                        <svg class="text-amber-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                        {{ $group['group'] }}
                    </h3>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($group['items'] as $skill)
                            <span class="skill-badge rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-sm font-medium text-slate-700">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        {{-- Security Arsenal: tools evidenced by public GitHub security research --}}
        <div class="reveal mt-5 rounded-xl border border-brand bg-brand-soft p-6">
            <h3 class="flex items-center gap-2 font-bold text-slate-900">
                <svg class="text-brand" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                Security Arsenal
            </h3>
            <p class="mt-2 text-sm leading-relaxed text-slate-600">Hands-on defensive tooling, evidenced by public research on <a href="https://github.com/sinnersman" target="_blank" rel="noopener" class="font-semibold text-brand hover:underline">GitHub @sinnersman</a>:</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">Burp Suite</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">ffuf (web fuzzing)</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">XSS Hunter (self-hosted)</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">Frida (mobile TLS audit)</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">GoDNS (DNS recon)</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">GoDork (exposure mapping)</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">Linux hardening</span>
                <span class="rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700">SSL/TLS analysis</span>
            </div>
        </div>
    </div>
</section>
