<?php

namespace Code16\Embed;

use Code16\Embed\ValueObjects\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

abstract class ServiceBase implements ServiceContract
{
    protected Url $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    abstract public static function detect(Url $url): bool;
    
    public function view(): View
    {
        return view($this->fullViewName(), $this->viewData());
    }
    
    protected function viewName(): string
    {
        return $this->guessViewName();
    }
    
    public function fullViewName(): string
    {
        return 'embed::services.' . $this->viewName();
    }

    public function viewData(): array
    {
        return [];
    }

    protected function guessViewName(): string
    {
        return Str::of(class_basename($this))->kebab()->lower();
    }
}
