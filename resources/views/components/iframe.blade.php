@props([
    'video' => false,
])

<iframe
    {{ $attributes }}
    srcdoc="{{ preg_replace('/\n\s*/', '', trim($slot)) }}"
    frameborder="0"
    scrolling="0"
    @if(!$video)
        onload="handleEmbedIframeLoaded(this)"
    @endif
></iframe>

@if(!$video)
    @once
        @push('embed::script')
            <script src="{{ mix('js/iframeResizer.min.js', '/vendor/embed') }}" async data-embed-script></script>
            <script>
                function handleEmbedIframeLoaded(iframe) {
                    function setup() {
                        iFrameResize({
                            heightCalculationMethod: 'documentElementOffset',
                            sizeWidth: true,
                            checkOrigin: false,
                        }, iframe);
                    }
                    if('iFrameResize' in window) {
                        setup();
                    } else {
                        document.querySelector('[data-embed-script]').addEventListener('load', setup);
                    }
                }
            </script>
        @endpush
    @endonce
@endif
