@props([
    /** @var \Code16\Embed\Services\YouTube $service */
    'service'
])

@php($message = "Unknown embed url : " . $service->embedUrl())
@php(Log::error($message))
<!-- {{ $message }} -->
