@props([
    'video' => false,
])

<iframe
    {{ $attributes }}
    srcdoc="{{ preg_replace('/\n\s*/', '', trim($slot)) }}"
    scrolling="0"
    @if(!$video)
        onload="handleEmbedIframeLoaded(this)"
    @endif
></iframe>

@if(!$video)
    @pushonce('embed::script')
        @php
            $hotFile = Vite::hotFile();
            Vite::useHotFile(public_path('vendor/embed/hot'));
        @endphp
        @vite(['resources/js/embed-iframe.js'], 'vendor/embed')
        @php
            Vite::useHotFile($hotFile);
        @endphp
    @endpushonce
@endif
