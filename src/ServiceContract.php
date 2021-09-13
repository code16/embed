<?php

namespace Code16\Embed;

use Illuminate\Contracts\View\View;
use Code16\Embed\ValueObjects\Ratio;
use Code16\Embed\ValueObjects\Url;

interface ServiceContract
{
    public static function detect(Url $url): bool;
    public function view(): View;
    public function fullViewName(): string;
    public function viewData(): array;
}
