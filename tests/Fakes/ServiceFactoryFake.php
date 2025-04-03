<?php

namespace Code16\Embed\Tests\Fakes;

use Code16\Embed\ServiceFactory;

class ServiceFactoryFake extends ServiceFactory
{
    protected string $serviceClassesPath = __DIR__.'/Services';
    protected string $serviceClassesNamespace = "Code16\Embed\Tests\Fakes\Services\\";
}
