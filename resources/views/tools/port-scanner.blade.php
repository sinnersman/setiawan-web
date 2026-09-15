@extends('layouts.app')

@section('title', 'Port Scanner — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">Port Scanner</h1>
    <p class="mt-2 text-slate-600">Pindai maksimal 16 port umum, timeout 1 detik per port. Dibatasi 1 pemindaian per 30 detik per sesi. Gunakan hanya pada host milik Anda atau yang mengizinkan.</p>

    <form method="POST" action="{{ route('tools.run', 'port-scanner') }}" class="mt-6">
        @csrf
        <div class="flex gap-2">
            <input type="text" name="host" value="{{ old('host') }}" placeholder="example.com" required maxlength="253"
                class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
            <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Scan</button>
        </div>
        @error('host')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        <div class="mt-4 grid grid-cols-2 gap-2 sm:grid-cols-4">
            @foreach (\App\Http\Controllers\ToolsController::COMMON_PORTS as $port => $service)
                <label class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm">
                    <input type="checkbox" name="ports[]" value="{{ $port }}" {{ in_array($port, [80, 443]) ? 'checked' : '' }} class="accent-[#0A66C2]">
                    <span class="font-mono font-bold">{{ $port }}</span>
                    <span class="text-slate-500">{{ $service }}</span>
                </label>
            @endforeach
        </div>
    </form>

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <p class="text-sm text-slate-600">Host <strong class="text-slate-900">{{ $result['host'] }}</strong> → <strong class="text-slate-900">{{ $result['ip'] }}</strong></p>
                <table class="mt-3 w-full text-sm">
                    <thead><tr class="text-left text-slate-500"><th class="py-1">Port</th><th>Layanan</th><th>Status</th><th>Latensi</th></tr></thead>
                    <tbody>
                        @foreach ($result['results'] as $r)
                            <tr class="border-t border-slate-200">
                                <td class="py-1.5 font-mono font-bold">{{ $r['port'] }}</td>
                                <td>{{ $r['service'] }}</td>
                                <td><span class="rounded px-2 py-0.5 text-xs font-bold {{ $r['status'] === 'open' ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-600' }}">{{ $r['status'] }}</span></td>
                                <td class="font-mono">{{ $r['latency_ms'] }} ms</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endisset
</div>
@endsection
