<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    @foreach($videos as $video)
    <url>
        <loc>{{ $video->getUrl() }}</loc>
        <video:video>
            <video:thumbnail_loc>{{{ $video->getImage() }}}</video:thumbnail_loc>
            <video:title>{!! preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $video->getTitle()) !!}</video:title>
            <video:description>{!! preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $video->getTeaser()) !!}</video:description>
        </video:video>
    </url>
    @endforeach
</urlset>
