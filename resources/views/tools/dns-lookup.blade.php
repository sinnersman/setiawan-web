@extends('layouts.app')

@section('title', 'DNS Lookup — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">DNS Lookup</h1>
    <p class="mt-2 text-slate-600">Lihat record DNS (A, AAAA, MX, TXT, NS, CNAME) sebuah domain.</p>

    <form method="POST" action="{{ route('tools.run', 'dns-lookup') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="host" value="{{ old('host') }}" placeholder="example.com" required maxlength="253"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Lookup</button>
    </form>
    @error('host')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <p class="text-sm text-slate-600">Hasil untuk <strong class="text-slate-900">{{ $result['host'] }}</strong></p>
                @foreach ($result['groups'] as $type => $records)
                    <h3 class="mt-4 font-mono text-sm font-bold text-slate-900">{{ $type }} ({{ count($records) }})</h3>
                    @if (empty($records))
                        <p class="text-sm text-slate-400">— tidak ada —</p>
                    @else
                        <ul class="mt-1 space-y-1 text-sm">
                            @foreach ($records as $r)
                                <li class="rounded bg-white px-3 py-1.5 font-mono text-xs text-slate-700 break-all">{{ $r['ip'] ?? $r['ipv6'] ?? $r['target'] ?? $r['host'] ?? $r['txt'] ?? $r['exchange'] ?? json_encode($r) }}</li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            @endif
        </div>
    @endisset
</div>
@endsection
