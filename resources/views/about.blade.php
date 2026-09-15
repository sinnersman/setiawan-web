@extends('layouts.app')

@section('title', 'About — ' . $profile['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
<section>
    <h2>About</h2>
    <div class="card">
        <p><strong>{{ $profile['name'] }}</strong> — {{ $profile['tagline'] }}.</p>
        <p style="margin-top:.6rem">{{ $profile['summary'] }}</p>
        <p class="meta" style="margin-top:.6rem">
            📍 {{ $profile['location'] }} · 🎂 {{ $profile['birth'] }}<br>
            📞 {{ $profile['phone'] }} · ✉️ {{ $profile['email'] }}<br>
            🔗 <a href="{{ $profile['linkedin'] }}" style="color:#38bdf8">{{ $profile['linkedin'] }}</a>
        </p>
    </div>
</section>

<section>
    <h2>Education</h2>
    @foreach ($education as $edu)
        <div class="card">
            <h3>{{ $edu['degree'] }}</h3>
            <p class="meta">{{ $edu['school'] }} · {{ $edu['period'] }}</p>
            <p>{{ $edu['description'] }}</p>
        </div>
    @endforeach
</section>

<section>
    <h2>Skills</h2>
    <div class="skills">
        @foreach ($skills as $skill)
            <span>{{ $skill }}</span>
        @endforeach
    </div>
</section>
</div>
@endsection
