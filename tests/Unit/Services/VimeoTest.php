<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\Services\Vimeo;
use Illuminate\Support\Facades\Http;

class VimeoTest extends ServiceTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::fake([
            'vimeo.com/api/oembed.json*' => Http::response([
                'html' => '<iframe src="https://player.vimeo.com/video/295522327?app_id=122963" width="640" height="360"></iframe>',
                'thumbnail_url' => 'https://i.vimeocdn.com/video/thumb.jpg',
            ]),
        ]);
    }

    protected function serviceClass(): string
    {
        return Vimeo::class;
    }

    protected function expectedViewName(): string
    {
        return 'vimeo';
    }

    protected function expectedViewData(): array
    {
        return [
            'service' => '295522327',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://vimeo.com/295522327',
        ];
    }

    protected function expectedEmbedUrl(bool $autoplay = false): string
    {
        return 'https://player.vimeo.com/video/295522327?app_id=122963&autoplay='.($autoplay ? 1 : 0);
    }
}
