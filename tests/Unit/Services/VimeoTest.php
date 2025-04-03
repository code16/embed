<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\Services\Vimeo;

class VimeoTest extends ServiceTestCase
{
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
            'videoId' => '295522327',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://vimeo.com/295522327',
        ];
    }
}
