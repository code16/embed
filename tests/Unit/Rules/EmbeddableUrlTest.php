<?php

namespace Code16\Embed\Tests\Unit\Rules;

use Code16\Embed\Rules\EmbeddableUrl;
use Code16\Embed\Services\Dailymotion;
use Code16\Embed\Services\Vimeo;
use Code16\Embed\Services\YouTube;
use Code16\Embed\Tests\EmbedTestCase;
use Illuminate\Support\Facades\Validator;

class EmbeddableUrlTest extends EmbedTestCase
{
    /** @test */
    public function it_passes_a_validUrl_for_any_service()
    {
        $validUrls = [
            'https://www.dailymotion.com/video/xg4y8d',
            'https://dai.ly/xg4y8d',
            'https://vimeo.com/148751763',
            'https://youtu.be/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ];

        foreach ($validUrls as $url) {
            $this->assertTrue((new EmbeddableUrl)->passes('', $url));
        }
    }

    /** @test */
    public function it_passes_for_an_allowed_service()
    {
        $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        $allowedServices = [
            YouTube::class,
        ];

        $this->assertTrue(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    /** @test */
    public function it_passes_for_multiple_allowed_services()
    {
        $validUrls = [
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://vimeo.com/148751763',
        ];
        $allowedServices = [
            YouTube::class,
            Vimeo::class,
        ];

        foreach ($validUrls as $url) {
            $this->assertTrue(
                (new EmbeddableUrl)
                    ->allowedServices($allowedServices)
                    ->passes('', $url)
            );
        }
    }

    /** @test */
    public function it_fails_for_an_invalid_url()
    {
        $this->assertFalse(
            (new EmbeddableUrl)
                ->passes('', 'xyz')
        );
    }

    /** @test */
    public function it_fails_for_an_unsupported_service()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $allowedServices = [
            YouTube::class,
        ];

        $this->assertFalse(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    /** @test */
    public function it_fails_for_service_not_in_allowed_list_single()
    {
        $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        $allowedServices = [
            Vimeo::class,
        ];

        $this->assertFalse(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    /** @test */
    public function it_fails_for_service_not_in_allowed_list_multiple()
    {
        $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        $allowedServices = [
            Vimeo::class,
            Dailymotion::class,
        ];

        $this->assertFalse(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    /** @test */
    public function it_replaces_supported_services_in_message_with_no_services_specified()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $rule = new EmbeddableUrl;
        $expectedMessage = 'The url must be a URL from one of the following services: Dailymotion, Vimeo or YouTube.';

        $this->assertValidationMessage($url, $rule, $expectedMessage);
    }

    protected function assertValidationMessage($url, $rule, $expectedMessage)
    {
        $attributeKey = 'url';
        $validator = Validator::make(
            [$attributeKey => $url],
            [$attributeKey => $rule],
        );

        $this->assertEquals($expectedMessage, $validator->messages()->get($attributeKey)[0]);
    }

    /** @test */
    public function it_replaces_supported_service_in_message()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $rule = (new EmbeddableUrl)->allowedServices([YouTube::class]);
        $expectedMessage = 'The url must be a URL from one of the following services: YouTube.';

        $this->assertValidationMessage($url, $rule, $expectedMessage);
    }

    /** @test */
    public function it_replaces_supported_services_list_in_message()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $rule = (new EmbeddableUrl)->allowedServices([YouTube::class, Vimeo::class, Dailymotion::class]);
        $expectedMessage = 'The url must be a URL from one of the following services: Dailymotion, Vimeo or YouTube.';

        $this->assertValidationMessage($url, $rule, $expectedMessage);
    }
}