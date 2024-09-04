<?php

namespace Code16\Embed;

use Code16\Embed\ValueObjects\Url;

interface ServiceContract
{
    public static function detect(Url $url): bool;
    public function fullViewName(): string;
    public function viewData(): array;
    public function videoId(): ?string;
    public function thumbnailUrl(): ?string;
}
