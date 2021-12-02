@props([
    'videoId',
    'autoplay' => false,
])

@php($params = [
    'autoplay' => $autoplay ? 1 : 0,
])

<iframe
    {{ $attributes }}
    frameborder="0"
    type="text/html"
    src="https://www.dailymotion.com/embed/video/{{ $videoId }}?{{ http_build_query($params) }}"
    allowfullscreen>
</iframe>
