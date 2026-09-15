@extends('layouts.app')

@section('title', 'SSL Checker — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">SSL Checker</h1>
    <p class="mt-2 text-slate-600">Periksa sertifikat TLS: penerbit, masa berlaku, SAN, sisa hari.</p>

    <form method="POST" action="{{ route('tools.run', 'ssl-checker') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="host" value="{{ old('host') }}" placeholder="example.com" required maxlength="253"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Check</button>
    </form>
    @error('host')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <dl class="grid gap-2 text-sm sm:grid-cols-2">
                    <div><dt class="text-slate-500">Host</dt><dd class="font-bold">{{ $result['host'] }}</dd></div>
                    <div><dt class="text-slate-500">Common Name</dt><dd class="font-mono">{{ $result['subject_cn'] }}</dd></div>
                    <div><dt class="text-slate-500">Issuer</dt><dd>{{ $result['issuer'] }}</dd></div>
                    <div><dt class="text-slate-500">Status</dt><dd>
                        @if ($result['expired'])
                            <span class="rounded bg-red-100 px-2 py-0.5 text-xs font-bold text-red-700">EXPIRED</span>
                        @else
                            <span class="rounded bg-green-100 px-2 py-0.5 text-xs font-bold text-green-700">VALID — {{ $result['days_left'] }} hari tersisa</span>
                        @endif
                    </dd></div>
                    <div><dt class="text-slate-500">Berlaku dari</dt><dd class="font-mono">{{ $result['valid_from'] }}</dd></div>
                    <div><dt class="text-slate-500">Berlaku sampai</dt><dd class="font-mono">{{ $result['valid_to'] }}</dd></div>
                </dl>
                <h3 class="mt-4 font-mono text-sm font-bold">SubjectAltName</h3>
                <p class="mt-1 font-mono text-xs break-all text-slate-700">{{ $result['san'] }}</p>
            @endif
        </div>
    @endisset
</div>
@endsection
