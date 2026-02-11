
<x-embed::iframe :video="$video" {{ $attributes }}>
    <x-embed::iframe-content :video="$video">
        <x-slot:head>{{ $head ?? null }}</x-slot:head>
        {!! $html ?? $slot !!}
    </x-embed::iframe-content>
</x-embed::iframe>
