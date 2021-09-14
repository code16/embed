<?php

namespace Code16\Embed;

use Code16\Embed\Exceptions\ServiceNotFoundException;
use Code16\Embed\Services\Fallback;
use Code16\Embed\Tests\Fakes\ServiceFactoryFake;
use Code16\Embed\ValueObjects\Url;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Finder\Finder;

class ServiceFactory
{
    protected string $serviceClassesPath = __DIR__ . '/Services';
    protected string $serviceClassesNamespace = "Code16\Embed\Services\\";

    public static function getByUrl(Url $url): ServiceContract
    {
        $factory = self::resolve();
        $cacheKey = 'laravel-embed-service::' . $url;

        if (Cache::has($cacheKey)) {
            $serviceClass = Cache::get($cacheKey);
            return new $serviceClass($url);
        }

        foreach ($factory->serviceClasses() as $serviceClass) {
            if ($serviceClass::detect($url)) {
                Cache::forever($cacheKey, $serviceClass);
                return new $serviceClass($url);
            };
        }

        throw new ServiceNotFoundException($url);
    }

    public static function getFallback(Url $url): ServiceContract
    {
        return new Fallback($url);
    }

    public function serviceClasses(): array
    {
        $directoryIterator = (new Finder)
            ->files()
            ->in($this->serviceClassesPath)
            ->depth(0)
            ->name('*.php')
            ->getIterator();

        foreach ($directoryIterator as $file) {
            $serviceClasses[] = $this->serviceClassesNamespace . $file->getFilenameWithoutExtension();
        }

        return $serviceClasses ?? [];
    }

    public static function fake(): void
    {
        app()->instance(ServiceFactory::class, new ServiceFactoryFake);
    }

    protected static function resolve(): self
    {
        return resolve(self::class);
    }
}
