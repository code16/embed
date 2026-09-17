<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\ServiceContract;
use Code16\Embed\Tests\EmbedTestCase;
use Code16\Embed\ValueObjects\Url;
use PHPUnit\Framework\Attributes\Test;

abstract class ServiceTestCase extends EmbedTestCase
{
    #[Test]
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

    #[Test]
    public function it_detects_appropriate_urls()
    {
        foreach ($this->validUrls() as $url) {
            $this->assertTrue(
                $this->service()->detect(new Url($url)),
                "Service didn't correctly detect: $url"
            );
        }
    }

    #[Test]
    public function it_has_expected_view_data()
    {
        $viewData = $this->service()->viewData();

        foreach ($this->expectedViewData() as $key => $value) {
            $this->assertArrayHasKey($key, $viewData);

            if ($key === 'service') {
                $this->assertInstanceOf($this->serviceClass(), $viewData[$key]);
                $this->assertEquals($value, $viewData[$key]->videoId());

                continue;
            }

            $this->assertEquals($value, $viewData[$key]);
        }
    }

    abstract protected function expectedViewData(): array;

    #[Test]
    public function it_generates_the_expected_embed_url()
    {
        $this->assertEquals($this->expectedEmbedUrl(), $this->service()->embedUrl());
        $this->assertEquals($this->expectedEmbedUrl(true), $this->service()->embedUrl(true));
    }

    abstract protected function expectedEmbedUrl(bool $autoplay = false): string;
}
