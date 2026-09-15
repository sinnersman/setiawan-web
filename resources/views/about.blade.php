@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
    <div class="reveal max-w-3xl">
        <p class="text-sm font-bold uppercase tracking-widest text-brand">About</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 md:text-4xl">{{ $data['profile']['name'] }}</h1>
        <p class="mt-2 text-lg font-semibold text-brand">{{ $data['profile']['tagline'] }}</p>
        <p class="mt-4 leading-relaxed text-slate-600">{{ $data['profile']['summary'] }}</p>
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($data['profile']['roles'] as $role)
                <span class="rounded-full bg-brand-soft px-3 py-1 text-xs font-semibold text-brand-dark">{{ $role }}</span>
            @endforeach
        </div>
    </div>

    <div class="mt-8 grid gap-5 md:grid-cols-2">
        <div class="reveal rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">Profile</h2>
            <dl class="mt-4 space-y-3 text-sm">
                <div class="flex gap-3">
                    <dt class="w-24 shrink-0 font-semibold text-slate-500">Location</dt>
                    <dd class="text-slate-800">{{ $data['profile']['location'] }}</dd>
                </div>
                <div class="flex gap-3">
                    <dt class="w-24 shrink-0 font-semibold text-slate-500">Birth</dt>
                    <dd class="text-slate-800">{{ $data['profile']['birth'] }}</dd>
                </div>
                <div class="flex gap-3">
                    <dt class="w-24 shrink-0 font-semibold text-slate-500">Phone</dt>
                    <dd class="text-slate-800">{{ $data['profile']['phone'] }}</dd>
                </div>
                <div class="flex gap-3">
                    <dt class="w-24 shrink-0 font-semibold text-slate-500">Email</dt>
                    <dd><a href="mailto:{{ $data['profile']['email'] }}" class="text-brand hover:text-brand-dark">{{ $data['profile']['email'] }}</a></dd>
                </div>
                <div class="flex gap-3">
                    <dt class="w-24 shrink-0 font-semibold text-slate-500">LinkedIn</dt>
                    <dd><a href="{{ $data['profile']['linkedin'] }}" target="_blank" rel="noopener" class="text-brand hover:text-brand-dark">linkedin.com/in/setiawan-risky</a></dd>
                </div>
            </dl>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ $data['profile']['whatsapp'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/></svg>
                    Chat WhatsApp
                </a>
                <a href="/contact" class="inline-flex items-center gap-2 rounded-lg bg-brand px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-brand-dark">Contact Form</a>
            </div>
        </div>

        <div class="reveal rounded-xl border border-slate-200 bg-slate-50 p-6" data-reveal-delay="120">
            <h2 class="text-lg font-bold text-slate-900">Education</h2>
            <p class="mt-2 font-semibold text-slate-800">{{ $data['education']['degree'] }}</p>
            <p class="text-sm font-medium text-brand">{{ $data['education']['school'] }}</p>
            <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $data['education']['note'] }}</p>
        </div>
    </div>

    <div class="reveal mt-8 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900">Skills</h2>
        @foreach ($data['skills'] as $group)
            <p class="mt-4 text-xs font-bold uppercase tracking-widest text-slate-400">{{ $group['group'] }}</p>
            <div class="mt-2 flex flex-wrap gap-2">
                @foreach ($group['items'] as $skill)
                    <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700">{{ $skill }}</span>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection
