@props([
     /** @var \Code16\Embed\Services\YouTube $service */
    'service',
    'autoplay' => false,
])

<iframe
    {{ $attributes }}
    src="{{ $service->embedUrl($autoplay) }}"
    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture; autoplay"
    allowfullscreen>
</iframe>
