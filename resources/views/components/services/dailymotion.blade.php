@props([
    'videoId'
])

<iframe
    {{ $attributes }}
    frameborder="0"
    type="text/html"
    src="https://www.dailymotion.com/embed/video/{{ $videoId }}"
    allowfullscreen>
</iframe>
