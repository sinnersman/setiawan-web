@extends('layouts.app')

@section('title', 'Initialize Scan — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">Initialize Scan</h1>
    <p class="mt-2 text-slate-600">Pemeriksaan awal host: resolusi DNS + keterjangkauan port 80/443 dengan latensi.</p>

    <form method="POST" action="{{ route('tools.run', 'initialize-scan') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="host" value="{{ old('host', request('host')) }}" placeholder="example.com" required maxlength="253"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Scan</button>
    </form>
    @error('host')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <p class="text-sm text-slate-600">Host <strong class="text-slate-900">{{ $result['host'] }}</strong> → <strong class="text-slate-900">{{ $result['ip'] }}</strong></p>
                <table class="mt-3 w-full text-sm">
                    <thead><tr class="text-left text-slate-500"><th class="py-1">Port</th><th>Layanan</th><th>Status</th><th>Latensi</th></tr></thead>
                    <tbody>
                        @foreach ($result['checks'] as $c)
                            <tr class="border-t border-slate-200">
                                <td class="py-1.5 font-mono">{{ $c['port'] }}</td>
                                <td>{{ $c['service'] }}</td>
                                <td><span class="rounded px-2 py-0.5 text-xs font-bold {{ $c['status'] === 'reachable' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $c['status'] }}</span></td>
                                <td class="font-mono">{{ $c['latency_ms'] }} ms</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endisset
</div>
@endsection
