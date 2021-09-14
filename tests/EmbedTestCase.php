<?php

namespace Code16\Embed\Tests;

use Orchestra\Testbench\TestCase;

class EmbedTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [\Code16\Embed\EmbedServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['view']->addNamespace('embed', __DIR__ . '/Fakes/views');
    }
}