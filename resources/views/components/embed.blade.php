@php
/**
 * @var \Code16\Embed\View\Components\Embed $self
 */
@endphp

@if($html)
    <x-embed::iframe {{ $attributes }}>
        <x-embed::iframe-content :html="$html" />
    </x-embed::iframe>
@elseif($url)
    <x-dynamic-component
        :component="$self->serviceComponentName()"
        :attributes="$self->serviceComponentAttributes()"
    />
@endif
