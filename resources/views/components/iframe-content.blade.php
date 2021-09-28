@props([
    'html',
    'video' => false,
])

<html @class(['video' => $video])>
    <head>
        <link rel="stylesheet" href="{{ mix('css/iframe-content.css', '/vendor/embed') }}">
    </head>
    <body style="margin: 0">
        {!! $html !!}
        <script src="{{ mix('iframeResizer.contentWindow.min.js', '/vendor/embed') }}"></script>
    </body>
</html>
