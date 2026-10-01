<?php

namespace Djfabrizia\Content\Tests\Legacy;

use Djfabrizia\Content\Legacy\ProducerListFormat;
use PHPUnit\Framework\TestCase;

class ProducerListFormatTest extends TestCase
{
    private const WORDPRESS_TEXT = "<p>Previous releases</p>\r\n"
        ."[{\"url\":\"https://open.spotify.com/track/1\", \"img\":\"https://i.scdn.co/image/a\", \"label\":\"Show Time - Radio&nbsp;Edit\"},\r\n"
        ."{\"url\":\"https://open.spotify.com/track/2\", \"img\":\"https://i.scdn.co/image/b\", \"label\":\"American Horse\"}\r\n]\r\n"
        ."<p>Unreleased edits <br />used in her sets</p>\r\n"
        ."[{\"url\":\"https://on.soundcloud.com/x\", \"img\":\"https://i1.sndcdn.com/y.jpg\", \"label\":\"Italo Disco Edit\"}\r\n]";

    public function test_the_wordpress_text_is_parsed_into_groups(): void
    {
        $groups = ProducerListFormat::parse(self::WORDPRESS_TEXT);

        $this->assertSame(['Previous releases', 'Unreleased edits <br />used in her sets'], array_column($groups, 'title'));
        $this->assertSame(['label' => 'American Horse', 'url' => 'https://open.spotify.com/track/2', 'image_url' => 'https://i.scdn.co/image/b'], $groups[0]['items'][1]);
    }

    public function test_formatting_the_parsed_groups_gives_back_the_exact_text(): void
    {
        $this->assertSame(self::WORDPRESS_TEXT, ProducerListFormat::format(ProducerListFormat::parse(self::WORDPRESS_TEXT)));
    }

    public function test_unreadable_text_gives_no_groups(): void
    {
        $this->assertSame([], ProducerListFormat::parse('Just some text'));
        $this->assertSame([], ProducerListFormat::parse('<p>Title</p> [not json]'));
        $this->assertSame([], ProducerListFormat::parse(null));
        $this->assertSame('', ProducerListFormat::format([]));
    }
}
