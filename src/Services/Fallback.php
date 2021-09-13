<?php

namespace Code16\Embed\Services;

use Code16\Embed\ServiceBase;
use Code16\Embed\ValueObjects\Url;

class Fallback extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return false;
    }

    public function viewData(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
