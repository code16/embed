<?php

namespace Code16\Embed\Services;

use Code16\Embed\ServiceBase;
use Code16\Embed\Services\Utils\IsVideoService;
use Illuminate\Support\Facades\Http;

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
    public function videoId(): ?string
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

    public function embedUrl(bool $autoplay = false): string
    {
        return sprintf('https://www.youtube-nocookie.com/embed/%s?%s', $this->videoId(), http_build_query([
            'autoplay' => $autoplay ? 1 : 0,
        ]));
    }

    public function thumbnailUrl(bool $maxResolution = true): ?string
    {
        return $this->cacheThumbnailUrl(function () use ($maxResolution) {
            $videoId = $this->videoId();

            if ($maxResolution && Http::head($url = "https://i.ytimg.com/vi/{$videoId}/maxresdefault.jpg")->status() == 200) {
                return $url;
            }

            return "https://i.ytimg.com/vi/{$videoId}/hqdefault.jpg";
        },
            $maxResolution ? 'max' : 'low'
        );
    }
}
