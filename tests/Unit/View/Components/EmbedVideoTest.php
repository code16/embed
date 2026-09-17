<?php

namespace Code16\Embed\Tests\Unit\View\Components;

use Code16\Embed\Tests\EmbedTestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class EmbedVideoTest extends EmbedTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            'vimeo.com/api/oembed.json*' => Http::response([
                'html' => '<iframe src="https://player.vimeo.com/video/295522327?h=7c6d5c70c8&amp;app_id=122963" width="640" height="360"></iframe>',
                'thumbnail_url' => 'https://i.vimeocdn.com/video/thumb.jpg',
            ]),
        ]);
    }

    public static function services(): array
    {
        return [
            'youtube' => [
                'https://youtu.be/MsiSPo2s3H4',
                'https://www.youtube-nocookie.com/embed/MsiSPo2s3H4?autoplay=0',
                'https://www.youtube-nocookie.com/embed/MsiSPo2s3H4?autoplay=1',
            ],
            'dailymotion' => [
                'https://www.dailymotion.com/video/12345',
                'https://www.dailymotion.com/embed/video/12345?autoplay=0',
                'https://www.dailymotion.com/embed/video/12345?autoplay=1',
            ],
            'vimeo' => [
                'https://vimeo.com/295522327',
                'https://player.vimeo.com/video/295522327?h=7c6d5c70c8&app_id=122963&autoplay=0',
                'https://player.vimeo.com/video/295522327?h=7c6d5c70c8&app_id=122963&autoplay=1',
            ],
        ];
    }

    #[Test]
    #[DataProvider('services')]
    public function it_renders_an_iframe_with_the_expected_src(string $url, string $expectedSrc, string $expectedAutoplaySrc)
    {
        $this->blade('<x-embed-video :url="$url" />', ['url' => $url])
            ->assertSee($expectedSrc)
            ->assertDontSee('&amp;amp;', false);

        $this->blade('<x-embed-video :url="$url" :autoplay="$autoplay" />', ['url' => $url, 'autoplay' => true])
            ->assertSee($expectedAutoplaySrc)
            ->assertDontSee('&amp;amp;', false);
    }

    #[Test]
    public function it_renders_the_fallback_for_an_unknown_url()
    {
        Log::shouldReceive('error')
            ->once()
            ->with('Unknown embed url : https://example.com/unknown-video');

        $this->blade('<x-embed-video :url="$url" />', ['url' => 'https://example.com/unknown-video'])
            ->assertSee('Unknown embed url : https://example.com/unknown-video', false);
    }
}
