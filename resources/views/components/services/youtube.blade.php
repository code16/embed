@props([
    'videoId'
])

<iframe
    {{ $attributes }}
    src="https://www.youtube-nocookie.com/embed/{{ $videoId }}"
    frameborder="0"
    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen>
</iframe>
