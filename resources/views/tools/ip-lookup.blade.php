@extends('layouts.app')

@section('title', 'IP Lookup — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">IP Lookup</h1>
    <p class="mt-2 text-slate-600">Resolusi &amp; klasifikasi IP/hostname (publik vs privat, reverse DNS).</p>

    <form method="POST" action="{{ route('tools.run', 'ip-lookup') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="query" value="{{ old('query') }}" placeholder="8.8.8.8 atau example.com" required maxlength="253"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Lookup</button>
    </form>
    @error('query')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <dl class="grid gap-2 text-sm sm:grid-cols-2">
                    <div><dt class="text-slate-500">IP</dt><dd class="font-mono font-bold">{{ $result['ip'] }}</dd></div>
                    <div><dt class="text-slate-500">Versi</dt><dd class="font-bold">{{ $result['version'] }}</dd></div>
                    <div><dt class="text-slate-500">Tipe</dt><dd><span class="rounded bg-brand px-2 py-0.5 text-xs font-bold text-white">IP {{ $result['type'] }}</span></dd></div>
                    <div><dt class="text-slate-500">Hostname input</dt><dd class="font-mono">{{ $result['hostname'] ?? '—' }}</dd></div>
                    <div class="sm:col-span-2"><dt class="text-slate-500">Reverse DNS</dt><dd class="font-mono font-bold">{{ $result['reverse_dns'] ?? '— tidak ada PTR —' }}</dd></div>
                </dl>
            @endif
        </div>
    @endisset
</div>
@endsection
