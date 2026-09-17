<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\Services\YouTube;

class YouTubeTest extends ServiceTestCase
{
    protected function serviceClass(): string
    {
        return YouTube::class;
    }

    protected function expectedViewName(): string
    {
        return 'youtube';
    }

    protected function expectedViewData(): array
    {
        return [
            'service' => 'MsiSPo2s3H4',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://youtu.be/MsiSPo2s3H4',
            'https://www.youtube.com/embed/MsiSPo2s3H4',
            'https://www.youtube.com/watch?v=MsiSPo2s3H4',
            'https://www.youtube.com/?v=MsiSPo2s3H4',
            'https://www.youtube.com/v/MsiSPo2s3H4',
            'https://www.youtube.com/e/MsiSPo2s3H4',
            'https://www.youtube.com/user/username#p/u/11/MsiSPo2s3H4',
            'https://www.youtube.com/sandalsResorts#p/c/54B8C800269D7C1B/0/MsiSPo2s3H4',
            'https://www.youtube.com/watch?feature=player_embedded&v=MsiSPo2s3H4',
            'https://www.youtube.com/?feature=player_embedded&v=MsiSPo2s3H4',
        ];
    }

    protected function expectedEmbedUrl(bool $autoplay = false): string
    {
        return 'https://www.youtube-nocookie.com/embed/MsiSPo2s3H4?autoplay='.($autoplay ? 1 : 0);
    }
}
