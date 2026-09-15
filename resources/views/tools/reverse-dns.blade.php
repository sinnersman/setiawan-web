@extends('layouts.app')

@section('title', 'Reverse DNS — Network Tools')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-brand">&larr; Semua Tools</a>
    <h1 class="mt-2 text-3xl font-extrabold tracking-tight">Reverse DNS</h1>
    <p class="mt-2 text-slate-600">Cari hostname (PTR) dari sebuah alamat IP.</p>

    <form method="POST" action="{{ route('tools.run', 'reverse-dns') }}" class="mt-6 flex gap-2">
        @csrf
        <input type="text" name="ip" value="{{ old('ip') }}" placeholder="8.8.8.8" required maxlength="45"
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-brand focus:outline-none">
        <button type="submit" class="rounded-lg bg-brand px-5 py-2 text-sm font-semibold text-white hover:bg-brand-dark">Lookup</button>
    </form>
    @error('ip')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    @isset($result)
        <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-5">
            @if (! $result['ok'])
                <p class="text-sm font-semibold text-red-600">Gagal: {{ $result['error'] }}</p>
            @else
                <p class="text-sm text-slate-600">IP <strong class="font-mono text-slate-900">{{ $result['ip'] }}</strong></p>
                <p class="mt-1 text-lg font-bold text-slate-900">{{ $result['hostname'] }}</p>
            @endif
        </div>
    @endisset
</div>
@endsection
