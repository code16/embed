<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\ServiceContract;
use Code16\Embed\Tests\EmbedTestCase;
use Code16\Embed\ValueObjects\Url;

abstract class ServiceTestCase extends EmbedTestCase
{
    /** @test */
    public function it_renders_the_correct_view()
    {
        $this->assertEquals('embed::services.'.$this->expectedViewName(), $this->service()->fullViewName());
    }

    abstract protected function expectedViewName(): string;

    protected function service(): ServiceContract
    {
        $serviceClass = $this->serviceClass();
        $url = new Url($this->validUrls()[0]);

        return new $serviceClass($url);
    }

    abstract protected function serviceClass(): string;

    abstract protected function validUrls(): array;

    /** @test */
    public function it_detects_appropriate_urls()
    {
        foreach ($this->validUrls() as $url) {
            $this->assertTrue(
                $this->service()->detect(new Url($url)),
                "Service didn't correctly detect: $url"
            );
        }
    }

    /** @test */
    public function it_has_expected_view_data()
    {
        foreach ($this->expectedViewData() as $key => $value) {
            $this->assertEquals($value, $this->service()->viewData()[$key]);
        }
    }

    abstract protected function expectedViewData(): array;
}
