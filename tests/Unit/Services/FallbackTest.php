<?php

namespace Code16\Embed\Tests\Unit\Services;

use Code16\Embed\Services\Fallback;
use Code16\Embed\Tests\EmbedTestCase;
use Code16\Embed\ValueObjects\Url;
use PHPUnit\Framework\Attributes\Test;

class FallbackTest extends EmbedTestCase
{
    #[Test]
    public function it_returns_the_original_url_as_embed_url()
    {
        $url = new Url('https://example.com/some-video');

        $this->assertEquals(
            'https://example.com/some-video',
            (new Fallback($url))->embedUrl()
        );

        $this->assertEquals(
            'https://example.com/some-video',
            (new Fallback($url))->embedUrl(true)
        );
    }
}
