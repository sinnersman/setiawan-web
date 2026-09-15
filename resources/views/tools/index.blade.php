@extends('layouts.app')

@section('title', 'Network Tools — Risky Setiawan')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
    <p class="text-sm font-semibold text-brand">Free Tools</p>
    <h1 class="mt-1 text-3xl font-extrabold tracking-tight">Network Tools</h1>
    <p class="mt-2 max-w-2xl text-slate-600">Diagnostik jaringan sisi server yang aman: validasi hostname/IP ketat, tanpa eksekusi shell. Port scanner dibatasi 16 port umum dengan throttle.</p>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($tools as $slug => $tool)
            <a href="{{ route('tools.show', $slug) }}" class="reveal card-lift rounded-xl border border-slate-200 bg-white p-5 transition hover:border-brand hover:shadow-md" data-reveal-delay="{{ min($loop->index * 60, 360) }}">
                <h2 class="font-bold text-slate-900">{{ $tool['title'] }}</h2>
                <p class="mt-1 text-sm text-slate-600">{{ $tool['description'] }}</p>
                <span class="mt-3 inline-block text-sm font-semibold text-brand">Buka tool &rarr;</span>
            </a>
        @endforeach
    </div>

    <h2 class="mt-12 text-2xl font-extrabold tracking-tight">Utility Tools</h2>
    <p class="mt-2 max-w-2xl text-slate-600">Perkakas sehari-hari: hash, password, chmod, base64, cron, JSON, markdown — murni PHP, tanpa eksekusi shell.</p>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @php
            $utilities = [
                'hash-generator' => ['Hash Generator', 'Hitung MD5, SHA-1, SHA-256, SHA-512, dan bcrypt dari teks.'],
                'pass-generator' => ['Password Generator', 'Buat password acak yang kuat (random_bytes) lengkap dengan skor entropi.'],
                'chmod-calc' => ['Chmod Calculator', 'Konversi oktal ke simbolik (dan sebaliknya) secara interaktif.'],
                'base64-conv' => ['Base64 Converter', 'Encode/decode Base64, URL-safe, dan hex.'],
                'cron-parser' => ['Cron Parser', 'Terjemahkan ekspresi cron ke deskripsi Bahasa Indonesia.'],
                'json-viewer' => ['JSON Viewer', 'Validasi dan pretty-print JSON.'],
                'markdown-viewer' => ['Markdown Viewer', 'Render markdown ke HTML yang aman.'],
            ];
        @endphp
        @foreach ($utilities as $slug => $util)
            <a href="{{ route('tools.' . $slug) }}" class="reveal card-lift rounded-xl border border-slate-200 bg-white p-5 transition hover:border-brand hover:shadow-md" data-reveal-delay="{{ min($loop->index * 60, 360) }}">
                <h2 class="font-bold text-slate-900">{{ $util[0] }}</h2>
                <p class="mt-1 text-sm text-slate-600">{{ $util[1] }}</p>
                <span class="mt-3 inline-block text-sm font-semibold text-brand">Buka tool &rarr;</span>
            </a>
        @endforeach
    </div>
</div>
@endsection
