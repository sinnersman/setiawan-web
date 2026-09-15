@extends('layouts.app')

@section('title', 'HTTP Headers — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">HTTP Headers</h1>
    <p class="mt-2 text-slate-600">Tampilkan status dan response header sebuah URL.</p>

    <form method="POST" action="{{ route('tools.run', 'http-headers') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="url" value="{{ old('url') }}" placeholder="https://example.com" required maxlength="500"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Fetch</button>
    </form>
    @error('url')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <p class="text-sm text-slate-600">URL final: <strong class="font-mono text-slate-900 break-all">{{ $result['url'] }}</strong></p>
                <ul class="mt-3 space-y-1 text-sm">
                    @foreach ($result['headers'] as $name => $value)
                        @if (is_int($name))
                            <li class="rounded bg-white px-3 py-1.5 font-mono text-xs font-bold text-slate-900">{{ $value }}</li>
                        @else
                            <li class="rounded bg-white px-3 py-1.5 font-mono text-xs break-all"><span class="font-bold text-brand">{{ $name }}:</span> <span class="text-slate-700">{{ is_array($value) ? implode('; ', $value) : $value }}</span></li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    @endisset
</div>
@endsection
