<?php

namespace Code16\Embed\Tests\Unit\ValueObjects;

use Code16\Embed\Tests\EmbedTestCase;
use Code16\Embed\ValueObjects\Url;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;

class UrlTest extends EmbedTestCase
{
    #[Test]
    public function it_accepts_a_valid_url()
    {
        $this->assertInstanceOf(Url::class, new Url('https://example.org'));
        $this->assertInstanceOf(Url::class, new Url('http://example.org'));
    }

    #[Test]
    public function it_throws_an_exception_for_an_invalid_url()
    {
        $this->expectException(InvalidArgumentException::class);
        new Url('not-a-val..id-url');
    }

    #[Test]
    public function it_can_be_cast_to_a_string()
    {
        $url = new Url('https://example.org');
        $this->assertEquals('https://example.org', (string) $url);
    }

    #[Test]
    public function it_attempts_to_prepend_https_if_missing()
    {
        $url = new Url('example.org');

        $this->assertInstanceOf(Url::class, $url);
        $this->assertEquals('https://example.org', (string) $url);
    }
}
