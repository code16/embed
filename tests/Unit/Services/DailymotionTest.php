<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\Services\Dailymotion;

class DailymotionTest extends ServiceTestCase
{
    protected function serviceClass(): string
    {
        return Dailymotion::class;
    }

    protected function expectedViewName(): string
    {
        return 'dailymotion';
    }

    protected function expectedViewData(): array
    {
        return [
            'videoId' => '12345',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://www.dailymotion.com/video/12345',
            'https://www.dailymotion.com/video/12345?playlist=67890',
            'https://dai.ly/12345',
        ];
    }
}
