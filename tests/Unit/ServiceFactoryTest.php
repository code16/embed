<?php

namespace Code16\Embed\Tests\Unit;

use Code16\Embed\Exceptions\ServiceNotFoundException;
use Code16\Embed\ServiceFactory;
use Code16\Embed\Services\Fallback;
use Code16\Embed\Tests\EmbedTestCase;
use Code16\Embed\Tests\Fakes\Services\FakeServiceOne;
use Code16\Embed\Tests\Fakes\Services\FakeServiceTwo;
use Code16\Embed\ValueObjects\Url;

class ServiceFactoryTest extends EmbedTestCase
{
    /** @test */
    public function it_can_get_a_service_by_url()
    {
        ServiceFactory::fake();

        $this->assertInstanceOf(FakeServiceOne::class, ServiceFactory::getByUrl(new Url('https://one.com')));
        $this->assertInstanceOf(FakeServiceTwo::class, ServiceFactory::getByUrl(new Url('https://two.com')));
    }

    /** @test */
    public function it_throws_an_exception_if_no_service_exists_to_handle_the_url()
    {
        ServiceFactory::fake();

        $this->expectException(ServiceNotFoundException::class);

        ServiceFactory::getByUrl(new Url('https://non-existing-service.com'));
    }

    /** @test */
    public function it_can_get_a_fallback_service()
    {
        $this->assertInstanceOf(Fallback::class,
            ServiceFactory::getFallback(new Url('https://non-existing-service.com')));
    }
}