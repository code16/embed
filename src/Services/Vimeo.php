<?php

namespace Code16\Embed\Services;

use Code16\Embed\ServiceBase;
use Code16\Embed\Services\Utils\IsVideoService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class Vimeo extends ServiceBase
{
    use IsVideoService;

    /**
     * @link https://stackoverflow.com/a/16841070/3498182
     */
    public function videoId(): ?string
    {
        preg_match(
            '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/',
            $this->url,
            $match
        );

        if (array_key_exists(5, $match)) {
            return $match[5];
        }

        return null;
    }

    public function thumbnailUrl(bool $maxResolution = true): ?string
    {
        return $this->cacheThumbnailUrl(function () use ($maxResolution) {
            try {
                $oembed = Http::get(sprintf(
                    'https://vimeo.com/api/oembed.json?url=%s&width=%d&height=%d',
                    rawurlencode($this->url),
                    $maxResolution ? 1920 : 640,
                    $maxResolution ? 1080 : 360
                ))
                    ->throw()
                    ->json();

                return $oembed['thumbnail_url'] ?? '';
            } catch (RequestException|ConnectionException $e) {
                return '';
            }
        },
            $maxResolution ? 'max' : 'low'
        );
    }
}
