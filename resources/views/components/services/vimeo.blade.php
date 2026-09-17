@props([
    /** @var \Code16\Embed\Services\Vimeo $service */
    'service',
    'autoplay' => false,
])

<iframe
    {{ $attributes }}
    src="{{ $service->embedUrl($autoplay) }}"
    allow="autoplay; fullscreen"
    allowfullscreen
></iframe>
