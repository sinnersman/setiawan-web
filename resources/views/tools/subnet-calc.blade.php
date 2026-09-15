@extends('layouts.app')

@section('title', 'Subnet Calculator — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">Subnet Calculator</h1>
    <p class="mt-2 text-slate-600">Hitung network, broadcast, mask, dan rentang host IPv4 (CIDR).</p>

    <form method="POST" action="{{ route('tools.run', 'subnet-calc') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="cidr" value="{{ old('cidr') }}" placeholder="192.168.1.0/24" required maxlength="20"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 font-mono text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Hitung</button>
    </form>
    @error('cidr')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <p class="text-sm text-slate-600">CIDR: <strong class="font-mono text-slate-900">{{ $result['cidr'] }}</strong></p>
                <dl class="mt-3 grid gap-2 font-mono text-sm sm:grid-cols-2">
                    <div class="rounded bg-white px-3 py-2"><dt class="font-sans text-xs text-slate-500">Network</dt><dd class="font-bold">{{ $result['network'] }}</dd></div>
                    <div class="rounded bg-white px-3 py-2"><dt class="font-sans text-xs text-slate-500">Broadcast</dt><dd class="font-bold">{{ $result['broadcast'] }}</dd></div>
                    <div class="rounded bg-white px-3 py-2"><dt class="font-sans text-xs text-slate-500">Subnet Mask (/{{ $result['prefix'] }})</dt><dd class="font-bold">{{ $result['mask'] }}</dd></div>
                    <div class="rounded bg-white px-3 py-2"><dt class="font-sans text-xs text-slate-500">Total / Usable</dt><dd class="font-bold">{{ number_format($result['total']) }} / {{ number_format($result['usable']) }}</dd></div>
                    <div class="rounded bg-white px-3 py-2"><dt class="font-sans text-xs text-slate-500">Host pertama</dt><dd class="font-bold">{{ $result['first'] }}</dd></div>
                    <div class="rounded bg-white px-3 py-2"><dt class="font-sans text-xs text-slate-500">Host terakhir</dt><dd class="font-bold">{{ $result['last'] }}</dd></div>
                </dl>
            @endif
        </div>
    @endisset
</div>
@endsection
