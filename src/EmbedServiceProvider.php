<?php

namespace Code16\Embed;

use Code16\Embed\View\Components\Embed;
use Code16\Embed\View\Components\EmbedVideo;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class EmbedServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('embed', Embed::class);
        Blade::component('embed-video', EmbedVideo::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'embed');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/embed'),
        ], 'views');
    
        $this->publishes([
            __DIR__.'/../resources/dist' => public_path('vendor/embed')
        ], 'assets');
    }
}
