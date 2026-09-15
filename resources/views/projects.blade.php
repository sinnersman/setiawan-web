@extends('layouts.app')

@section('title', 'Projects — ' . $profile['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-12 sm:px-6 md:py-16">
<section>
    <h2>Projects ({{ count($projects) }})</h2>
    @foreach ($projects as $project)
        <div class="card">
            <h3>{{ $project['name'] }}</h3>
            <p class="meta">{{ $project['org'] }}</p>
            <p>{{ $project['description'] }}</p>
            <div class="tags">
                @foreach ($project['tags'] as $tag)
                    <span>{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    @endforeach
</section>

<section>
    <h2>Open Source di GitHub ({{ $github['public_repos'] }} public repos)</h2>
    <p class="meta">
        <a href="{{ $github['url'] }}" target="_blank" rel="noopener">@{{ $github['username'] }}</a>
        &middot; <a href="{{ $github['blog'] }}" target="_blank" rel="noopener">{{ $github['blog'] }}</a>
    </p>
    @foreach ($githubProjects as $repo)
        <div class="card">
            <h3><a href="{{ $repo['url'] }}" target="_blank" rel="noopener">{{ $repo['name'] }}</a></h3>
            <p class="meta">{{ $repo['language'] }}</p>
            <p>{{ $repo['description'] }}</p>
        </div>
    @endforeach
    <p><a href="{{ $github['url'] }}?tab=repositories" target="_blank" rel="noopener">Lihat semua di GitHub</a></p>
</section>
</div>
@endsection
