<footer>
    <div class="wrap">
        <p>&copy; {{ date('Y') }} {{ $profile['name'] ?? 'Risky Setiawan' }} · {{ $profile['location'] ?? 'Cirebon, Indonesia' }}</p>
        <p><a href="mailto:{{ $profile['email'] ?? '' }}" style="color:#38bdf8">{{ $profile['email'] ?? '' }}</a> · {{ $profile['phone'] ?? '' }}</p>
    </div>
</footer>
