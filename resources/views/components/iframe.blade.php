
<iframe
    {{ $attributes }}
    srcdoc="{{ preg_replace('/\n\s*/', '', trim($slot)) }}"
    frameborder="0"
    scrolling="0"
    onload="handleEmbedIframeLoaded(this)"
></iframe>

@once
    @push('embed::script')
        <script src="{{ mix('iframeResizer.min.js', '/vendor/embed') }}"></script>
        <script>
            function handleEmbedIframeLoaded(iframe) {
                iFrameResize({
                    heightCalculationMethod: 'documentElementOffset',
                    sizeWidth: true,
                    checkOrigin: false,
                }, iframe);
            }
        </script>
    @endpush
@endonce
