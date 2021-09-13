<?php

namespace Code16\Embed;

use Code16\Embed\ValueObjects\Url;
use Illuminate\Contracts\View\View;

interface ServiceContract
{
    public static function detect(Url $url): bool;
    public function view(): View;
    public function fullViewName(): string;
    public function viewData(): array;
}
