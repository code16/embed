<?php

namespace Code16\Embed\View\Components;

use Illuminate\View\Component;

class Embed extends Component
{
    public string $html;

    public function __construct(string $html)
    {
        $this->html = $html;
    }
    
    public function render()
    {
        return view('embed::components.embed');
    }
}
