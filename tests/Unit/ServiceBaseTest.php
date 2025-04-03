<?php

namespace Code16\Embed\Tests\Unit;

use Code16\Embed\Tests\EmbedTestCase;
use Code16\Embed\Tests\Fakes\Services\FakeServiceOne;
use Code16\Embed\Tests\Fakes\Services\FakeServiceTwo;
use Code16\Embed\ValueObjects\Url;

class ServiceBaseTest extends EmbedTestCase
{
    /** @test */
    public function it_can_guess_view_name()
    {
        $this->assertEquals(
            'embed::services.fake-service-one',
            (new FakeServiceOne(new Url('https://one.com')))->fullViewName()
        );

        $this->assertEquals(
            'embed::services.fake-service-two',
            (new FakeServiceTwo(new Url('https://two.com')))->fullViewName()
        );
    }

    /** @test */
    public function it_can_pass_view_data()
    {
        $this->assertEquals(
            'bar',
            (new FakeServiceOne(new Url('https://one.com')))->viewData()['foo']
        );
    }
}
