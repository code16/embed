<?php

namespace Code16\Embed\Services;

use Code16\Embed\ServiceBase;
use Code16\Embed\Services\Utils\IsVideoService;

class Dailymotion extends ServiceBase
{
    use IsVideoService;

    /**
     * @link https://github.com/OpenCode/awesome-regex#dailymotion
     */
    protected function videoId(): ?string
    {
        preg_match('/^https?:\/\/(?:www\.)?(?:dai\.ly\/|dailymotion\.com\/(?:.+?video=|(?:video|hub)\/))([a-z0-9]+)/i', $this->url, $match);

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return null;
    }
}
