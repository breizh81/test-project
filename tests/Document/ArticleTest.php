<?php

namespace Document;

use App\Document\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testGetters(): void
    {
        $xml = '<article><content>Some content</content></article>';
        $title = 'Test Article';
        $article = new Article($xml, $title);

        $this->assertEquals($xml, $article->getXml());
        $this->assertEquals($title, $article->getTitle());
    }
}
