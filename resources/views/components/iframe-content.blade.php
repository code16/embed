@props([
    'video' => false,
])

<html class="{{ $video ? 'video' : '' }}">
    <head>
        @php
            $hotFile = Vite::hotFile();
            Vite::useHotFile(public_path('vendor/embed/hot'));
        @endphp
        @if(!$video)
            @vite(['resources/js/embed-iframe-content.js'], 'vendor/embed')
        @endif
        @vite(['resources/css/embed-iframe-content.css'], 'vendor/embed')
        @php
            Vite::useHotFile($hotFile);
        @endphp
        {{ $head ?? null }}
    </head>
    <body style="margin: 0">
        {{ $slot }}
    </body>
</html>
