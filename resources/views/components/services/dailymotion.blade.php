@props([
    /** @var \Code16\Embed\Services\Dailymotion $service */
    'service',
    'autoplay' => false,
])


<iframe
    {{ $attributes }}
    src="{{ $service->embedUrl($autoplay) }}"
    allowfullscreen>
</iframe>
