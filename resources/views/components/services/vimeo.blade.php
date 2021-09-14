@props([
    'videoId'
])

<iframe
    {{ $attributes }}
    src="https://player.vimeo.com/video/{{ $videoId }}"
    frameborder="0"
    allow="autoplay; fullscreen"
    allowfullscreen
></iframe>
