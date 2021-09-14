@php
    /**
     * @var \Code16\Embed\View\Components\Embed $self
     */
@endphp

<x-dynamic-component
        :component="$self->serviceComponentName()"
        :attributes="$self->serviceComponentAttributes()"
/>
