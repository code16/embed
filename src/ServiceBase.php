<?php

namespace Code16\Embed;

use Code16\Embed\ValueObjects\Url;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

abstract class ServiceBase implements ServiceContract
{
    protected Url $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    abstract public static function detect(Url $url): bool;

    public function fullViewName(): string
    {
        return 'embed::services.'.$this->viewName();
    }

    public function viewData(): array
    {
        return [];
    }

    protected function viewName(): string
    {
        return $this->guessViewName();
    }

    protected function guessViewName(): string
    {
        return Str::of(class_basename($this))->kebab()->lower();
    }

    protected function cacheThumbnailUrl(\Closure $callback, ?string $cacheKey = null): ?string
    {
        $cacheKey = sprintf('laravel-embed-thumbnail::%s_%s', $this->url, $cacheKey ?: 'default');

        if (($url = Cache::get($cacheKey)) !== null) {
            return $url;
        }

        $url = $callback();

        if ($url) {
            Cache::forever($cacheKey, $url);
        } else {
            Cache::put($cacheKey, '', now()->addDay());
        }

        return $url;
    }
}
