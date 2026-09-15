<nav>
    <div class="wrap">
        <a class="brand" href="{{ route('home') }}">{{ $profile['name'] ?? config('app.name') }}</a>
        <ul>
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('experience') }}" class="{{ request()->routeIs('experience') ? 'active' : '' }}">Experience</a></li>
            <li><a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') ? 'active' : '' }}">Projects</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact*') ? 'active' : '' }}">Contact</a></li>
        </ul>
    </div>
</nav>
