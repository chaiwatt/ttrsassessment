<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{url('')}}</loc>
        @php
            $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') );
        @endphp
        <lastmod>{{ $date->format('Y-m-d H:i:s') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    @foreach ($pages as $page)
        <url>
            <loc>{{route('landing.page',['slug' => $page->slug])}}</loc>
            <lastmod>{{ $page->created_at }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>