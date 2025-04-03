<?php

namespace Code16\Embed\View\Components;

use Illuminate\View\Component;

class Embed extends Component
{
    public function __construct(
        public ?string $html = null,
        public bool $video = false // force full height + full width
    ) {
    }

    public function render()
    {
        return view('embed::components.embed');
    }
}
