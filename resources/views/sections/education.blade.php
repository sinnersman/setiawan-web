{{-- Education --}}
<section id="education" class="scroll-mt-24 border-b border-slate-200 bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 md:py-18">
        <div class="reveal max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">Background</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Education</h2>
        </div>
        <div class="reveal mt-8 flex max-w-3xl items-start gap-4 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand-soft text-brand-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-3.5"/><path d="M22 10v6"/></svg>
            </span>
            <div>
                <h3 class="font-bold text-slate-900">{{ $data['education']['degree'] }}</h3>
                <p class="mt-0.5 text-sm font-semibold text-brand">{{ $data['education']['school'] }}</p>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $data['education']['note'] }}</p>
            </div>
        </div>
    </div>
</section>
