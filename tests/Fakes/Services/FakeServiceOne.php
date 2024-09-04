<?php

namespace Code16\Embed\Tests\Fakes\Services;

use Code16\Embed\ServiceBase;
use Code16\Embed\ValueObjects\Url;
use Illuminate\Support\Str;

class FakeServiceOne extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return Str::contains($url, 'https://one.com');
    }

    public function viewData(): array
    {
        return [
            'foo' => 'bar',
        ];
    }
    
    public function videoId(): ?string
    {
        return null;
    }
    
    public function thumbnailUrl(bool $maxResolution = true): ?string
    {
        return null;
    }
}
