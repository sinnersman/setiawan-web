{{-- Experience timeline (10 items, newest first) --}}
<section id="experience" class="scroll-mt-24 border-b border-slate-200 bg-slate-50">
    <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 md:py-18">
        <div class="reveal max-w-3xl">
            <p class="text-sm font-bold uppercase tracking-widest text-brand">Career</p>
            <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Experience Timeline</h2>
            <p class="mt-2 text-slate-500">Roles, flagship projects, and education milestones in one track.</p>
        </div>
        <ol class="timeline mt-10">
            @foreach ($data['timeline'] as $item)
                <li class="timeline-item reveal" data-reveal-delay="{{ min($loop->index * 60, 480) }}">
                    <span class="timeline-dot
                        @if ($item['type'] === 'work') bg-brand
                        @elseif ($item['type'] === 'project') bg-amber-500
                        @else bg-emerald-500 @endif" aria-hidden="true"></span>
                    <div class="timeline-card rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="rounded-full px-2.5 py-0.5 text-xs font-bold
                                @if ($item['type'] === 'work') bg-brand-soft text-brand-dark
                                @elseif ($item['type'] === 'project') bg-amber-100 text-amber-800
                                @else bg-emerald-100 text-emerald-800 @endif">
                                {{ ucfirst($item['type']) }}
                            </span>
                            @if (!empty($item['period']))
                                <span class="text-xs font-medium text-slate-400">{{ $item['period'] }}</span>
                            @endif
                        </div>
                        <h3 class="mt-2 font-bold text-slate-900">{{ $item['title'] }}</h3>
                        <p class="mt-0.5 text-sm font-medium text-brand">{{ $item['organization'] }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $item['description'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
