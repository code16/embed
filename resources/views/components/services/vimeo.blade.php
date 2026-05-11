@props([
    'videoId',
    'autoplay' => false,
])

@php($params = [
    'autoplay' => $autoplay ? 1 : 0,
])

<iframe
    {{ $attributes }}
    src="https://player.vimeo.com/video/{{ $videoId }}?{{ http_build_query($params) }}"
    allow="autoplay; fullscreen"
    allowfullscreen
></iframe>
