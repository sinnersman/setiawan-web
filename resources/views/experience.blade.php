@extends('layouts.app')

@section('title', 'Experience — ' . $profile['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
<section>
    <h2>Experience ({{ count($experiences) }})</h2>
    @foreach ($experiences as $exp)
        <div class="card">
            <h3>{{ $exp['role'] }}</h3>
            <p class="meta">{{ $exp['company'] }} · {{ $exp['period'] }}</p>
            <p>{{ $exp['description'] }}</p>
        </div>
    @endforeach
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
    <h2>Publications</h2>
    @foreach ($publications as $pub)
        <div class="card">
            <h3>{{ $pub['title'] }}</h3>
            <p class="meta">{{ $pub['venue'] }}</p>
            <p>{{ $pub['description'] }}</p>
        </div>
    @endforeach
</section>

<section>
    <h2>Patents</h2>
    @foreach ($patents as $pat)
        <div class="card">
            <h3>{{ $pat['title'] }}</h3>
            <p class="meta">{{ $pat['holder'] }}</p>
            <p>{{ $pat['description'] }}</p>
        </div>
    @endforeach
</section>
</div>
@endsection
