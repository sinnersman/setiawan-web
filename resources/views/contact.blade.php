@extends('layouts.app')

@section('title', 'Contact — ' . $profile['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
<section>
    <h2>Contact</h2>
    <div class="card">
        <p>📞 {{ $profile['phone'] }}</p>
        <p>✉️ <a href="mailto:{{ $profile['email'] }}" style="color:#38bdf8">{{ $profile['email'] }}</a></p>
        <p>🔗 <a href="{{ $profile['linkedin'] }}" style="color:#38bdf8">{{ $profile['linkedin'] }}</a></p>
        <p class="meta">📍 {{ $profile['location'] }}</p>
    </div>
</section>

<section>
    <h2>Kirim Pesan</h2>
    <div class="card">
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf
            <label for="name">Nama</label>
            <input id="name" name="name" value="{{ old('name') }}" required maxlength="100">
            @error('name')<p class="error">{{ $message }}</p>@enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required maxlength="150">
            @error('email')<p class="error">{{ $message }}</p>@enderror

            <label for="subject">Subjek</label>
            <input id="subject" name="subject" value="{{ old('subject') }}" required maxlength="150">
            @error('subject')<p class="error">{{ $message }}</p>@enderror

            <label for="message">Pesan</label>
            <textarea id="message" name="message" rows="5" required maxlength="5000">{{ old('message') }}</textarea>
            @error('message')<p class="error">{{ $message }}</p>@enderror

            <button class="btn" type="submit">Kirim</button>
        </form>
    </div>
</section>
</div>
@endsection
