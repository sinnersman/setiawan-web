@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
    <div class="reveal max-w-3xl">
        <p class="text-sm font-bold uppercase tracking-widest text-brand">Work</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 md:text-4xl">Security Research and Projects</h1>
        <p class="mt-2 text-slate-500">Defensive research and open-source tooling on GitHub — {{ $data['github']['public_repos'] }} public repositories as @<a href="{{ $data['github']['url'] }}" target="_blank" rel="noopener" class="font-semibold text-brand hover:text-brand-dark">{{ $data['github']['username'] }}</a>.</p>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($data['githubProjects'] as $repo)
            <article class="reveal card-lift flex flex-col rounded-xl border border-slate-200 bg-white p-6 shadow-sm" data-reveal-delay="{{ min($loop->index * 70, 420) }}">
                <div class="flex items-center justify-between gap-2">
                    <h3 class="font-bold text-slate-900">
                        <a href="{{ $repo['url'] }}" target="_blank" rel="noopener" class="hover:text-brand">{{ $repo['name'] }}</a>
                    </h3>
                    <span class="shrink-0 rounded-full bg-brand-soft px-2.5 py-1 text-xs font-semibold text-brand-dark">{{ $repo['language'] }}</span>
                </div>
                <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $repo['description'] }}</p>
                <a href="{{ $repo['url'] }}" target="_blank" rel="noopener" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand hover:text-brand-dark">
                    View on GitHub
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                </a>
            </article>
        @endforeach
    </div>

    <div class="reveal mt-8 rounded-xl border border-slate-200 bg-slate-50 p-6 text-center">
        <p class="text-sm text-slate-600">Explore the full archive on GitHub and the personal blog.</p>
        <div class="mt-4 flex flex-wrap justify-center gap-3">
            <a href="{{ $data['github']['url'] }}?tab=repositories" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark">All Repositories</a>
            <a href="{{ $data['github']['blog'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-brand hover:text-brand">Personal Blog</a>
        </div>
    </div>
</div>
@endsection
