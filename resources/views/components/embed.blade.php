
<x-embed::iframe :video="$video" {{ $attributes }}>
    <x-embed::iframe-content
        :html="$html ?? $slot"
        :video="$video"
    />
</x-embed::iframe>
