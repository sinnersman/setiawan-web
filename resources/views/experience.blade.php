@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
    <div class="reveal max-w-3xl">
        <p class="text-sm font-bold uppercase tracking-widest text-brand">Career</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 md:text-4xl">Experience Timeline</h1>
        <p class="mt-2 text-slate-500">Roles, flagship projects, and education milestones in one track. {{ count($data['timeline']) }} items.</p>
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

    <div class="mt-10 grid gap-5 md:grid-cols-2">
        <div class="reveal rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Education</p>
            <h2 class="mt-1 font-bold text-slate-900">{{ $data['education']['degree'] }}</h2>
            <p class="text-sm font-medium text-brand">{{ $data['education']['school'] }}</p>
            <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $data['education']['note'] }}</p>
        </div>
        <div class="reveal rounded-xl border border-slate-200 bg-white p-6 shadow-sm" data-reveal-delay="120">
            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Publications and Patents</p>
            <ul class="mt-3 space-y-3">
                @foreach ($data['publications'] as $pub)
                    <li>
                        <span class="rounded-full bg-brand-soft px-2.5 py-0.5 text-xs font-bold text-brand-dark">{{ $pub['kind'] }}</span>
                        <p class="mt-1 text-sm font-bold text-slate-900">{{ $pub['title'] }}</p>
                        <p class="text-sm text-slate-600">{{ $pub['detail'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
