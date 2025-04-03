<?php

namespace Code16\Embed\View\Components;

use Code16\Embed\ServiceContract;
use Code16\Embed\ServiceFactory;
use Code16\Embed\ValueObjects\Url;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

class EmbedVideo extends Component
{
    protected ServiceContract $service;
    protected Url $url;

    public function __construct(
        string $url,
        public bool $autoplay = false,
    ) {
        $this->url = new Url($url);
        $this->service = $this->findService();
    }

    private function findService(): ServiceContract
    {
        $this->service = ServiceFactory::getByUrl($this->url) ?: ServiceFactory::getFallback($this->url);

        return $this->service;
    }

    public function serviceComponentName(): string
    {
        return $this->service->fullViewName();
    }

    public function serviceComponentAttributes(): ComponentAttributeBag
    {
        return $this->attributes->merge($this->service->viewData());
    }

    public function render()
    {
        return view('embed::components.embed-video', [
            'self' => $this,
        ]);
    }
}
