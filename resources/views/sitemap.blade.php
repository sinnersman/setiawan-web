{{ '<?xml version="1.0" encoding="UTF-8"?>' }}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($urls as $u)
    <url>
        <loc>{{ $u['loc'] }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($u['lastmod'])->toDateString() }}</lastmod>
        <changefreq>{{ $u['changefreq'] }}</changefreq>
        <priority>{{ $u['priority'] }}</priority>
        <xhtml:link rel="alternate" hreflang="id" href="{{ $u['loc'] }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ $u['loc'] }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $u['loc'] }}"/>
    </url>
@endforeach
</urlset>
