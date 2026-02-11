@props([
    'video' => false,
])

<html class="{{ $video ? 'video' : '' }}">
    <head>
        @if(!$video)
            @vite(['resources/js/embed-iframe-content.js'], 'vendor/embed')
        @endif
        @vite(['resources/css/embed-iframe-content.css'], 'vendor/embed')
        {{ $head ?? null }}
    </head>
    <body style="margin: 0">
        {{ $slot }}
    </body>
</html>
