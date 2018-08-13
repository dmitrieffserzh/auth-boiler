<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- STATIC PAGES -->
    @if($page)
        @foreach($page as $item)
            <url>
                <loc>{{ url($item->slug) }}</loc>
                <lastmod>{{ $item->updated_at->tz('GMT')->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>1</priority>
            </url>
        @endforeach
    @endif

    <!-- NEWS -->
    @if($news)
        @foreach($news as $item)
            <url>
                <loc>{{ url($item->slug) }}</loc>
                <lastmod>{{ $item->updated_at->tz('GMT')->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>1</priority>
            </url>
        @endforeach
    @endif
</urlset>