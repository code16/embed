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
    
    public function videoId(): ?string
    {
        return null;
    }
    
    public function thumbnailUrl(bool $maxResolution = true): ?string
    {
        return null;
    }
    
    public function viewData(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
