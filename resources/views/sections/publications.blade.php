{{-- Publications, patents & awards --}}
<section id="publications" class="scroll-mt-24 border-b border-slate-200">
    <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 md:py-18">
        <div class="reveal max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">Recognition</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Publications &amp; Awards</h2>
        </div>
        <div class="mt-8 grid gap-5 md:grid-cols-3">
            @foreach ($data['publications'] as $pub)
                <article class="reveal rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <span class="inline-block rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-bold text-amber-800">{{ $pub['kind'] }}</span>
                    <h3 class="mt-3 font-bold leading-snug text-slate-900">{{ $pub['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $pub['detail'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
