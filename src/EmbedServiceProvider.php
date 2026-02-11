<?php

namespace Code16\Embed;

use Code16\Embed\View\Components\Embed;
use Code16\Embed\View\Components\EmbedVideo;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
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

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'embed');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/embed'),
        ], 'embed-views');

        $this->publishes([
            __DIR__.'/../resources/dist' => public_path('vendor/embed'),
        ], 'embed-assets');

        Event::listen(CommandStarting::class, function (CommandStarting $event) {
            if ($event->command === 'vendor:publish'
                && $event->input->getOption('tag')
                && in_array('embed-assets', $event->input->getOption('tag'))
            ) {
                if (File::exists(public_path('vendor/embed'))) {
                    File::deleteDirectory(public_path('vendor/embed'));
                }
            }
        });
    }
}
