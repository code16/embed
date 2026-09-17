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

    protected function getOembed(int $width = 1920, int $height = 1080)
    {
        return once(
            fn () => Http::get(sprintf(
                'https://vimeo.com/api/oembed.json?url=%s&width=%d&height=%d',
                rawurlencode($this->url),
                $width,
                $height
            ))
                ->throw()
                ->json()
        );
    }

    public function embedUrl(bool $autoplay = false): string
    {
        $url = $this->cacheEmbedUrl(function () {
            try {
                $oembed = $this->getOembed();

                if (isset($oembed['html']) && preg_match('/src="([^"]+)"/', $oembed['html'], $match)) {
                    return html_entity_decode($match[1]);
                }

                return '';
            } catch (RequestException|ConnectionException $e) {
                return '';
            }
        });

        $url = $url ?: sprintf('https://player.vimeo.com/video/%s', $this->videoId());

        return $url.(str_contains($url, '?') ? '&' : '?').http_build_query([
            'autoplay' => $autoplay ? 1 : 0,
        ]);
    }

    public function thumbnailUrl(bool $maxResolution = true): ?string
    {
        return $this->cacheThumbnailUrl(function () use ($maxResolution) {
            try {
                $oembed = $this->getOembed(
                    width: $maxResolution ? 1920 : 640,
                    height: $maxResolution ? 1080 : 360
                );

                return $oembed['thumbnail_url'] ?? '';
            } catch (RequestException|ConnectionException $e) {
                return '';
            }
        },
            $maxResolution ? 'max' : 'low'
        );
    }
}
