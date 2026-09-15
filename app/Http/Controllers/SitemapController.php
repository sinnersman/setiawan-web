<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Serve sitemap.xml — single-page portfolio + anchor sections.
     * Google accepts fragment-free URLs only, so the sitemap lists
     * the canonical page (id + en hreflang alternates via xhtml:link).
     */
    public function index(): Response
    {
        $base = rtrim(config('app.url'), '/');
        $now = now()->toAtomString();

        $urls = [
            ['loc' => $base . '/', 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '1.0'],
        ];

        $xml = view('sitemap', compact('urls', 'base'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml; charset=UTF-8');
    }
}
