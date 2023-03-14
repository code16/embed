<?php

namespace Code16\Embed\Services;

use Code16\Embed\ServiceBase;
use Code16\Embed\Services\Utils\IsVideoService;

class YouTube extends ServiceBase
{
    use IsVideoService;

    protected function viewName(): string
    {
        return 'youtube';
    }

    /**
     * @link https://stackoverflow.com/a/6382259/3498182
     */
    protected function videoId(): ?string
    {
        preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i',
            $this->url,
            $match
        );

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return null;
    }
}
