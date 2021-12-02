@php
/**
 * @var \Code16\Embed\View\Components\EmbedVideo $self
 */
@endphp

<x-dynamic-component
    :component="$self->serviceComponentName()"
    :attributes="$self->serviceComponentAttributes()"
    :autoplay="$autoplay"
/>
