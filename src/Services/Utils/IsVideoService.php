<?php

namespace Code16\Embed\Services\Utils;

use Code16\Embed\ValueObjects\Url;

trait IsVideoService
{
    public static function detect(Url $url): bool
    {
        return (new self($url))->videoId() !== null;
    }

    public function viewData(): array
    {
        return [
            'videoId' => $this->videoId(),
        ];
    }
}
