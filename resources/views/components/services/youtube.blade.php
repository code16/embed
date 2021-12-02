@props([
    'videoId',
    'autoplay' => false,
])

@php($params = [
    'autoplay' => $autoplay ? 1 : 0,
])

<iframe
    {{ $attributes }}
    src="https://www.youtube-nocookie.com/embed/{{ $videoId }}?{{ http_build_query($params) }}"
    frameborder="0"
    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture; autoplay"
    allowfullscreen>
</iframe>
