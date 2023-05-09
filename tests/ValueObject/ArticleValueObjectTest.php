<?php

namespace ValueObject;

use App\Document\Article;
use App\Document\ArticleInterface;
use App\ValueObject\ArticleValueObject;
use DOMElement;
use PHPUnit\Framework\TestCase;

class ArticleValueObjectTest extends TestCase
{

    /**
     * @dataProvider providerTestDeserializeToDOMElement
     */
    public function testDeserializeToDOMElement(ArticleInterface $article, DOMElement $DOMElement): void
    {
        $articleValueObject = new ArticleValueObject($article);
        self::assertEquals($DOMElement, $articleValueObject->transformToDOMElement());
    }

    public function providerTestDeserializeToDOMElement(): array
    {
        $xml = '<Article id="a5147990-9191-4fdf-968b-6ae5f562cef3"><CreationDate>2020-05-19T13:17:11+02:00</CreationDate>
                <Type>standard</Type>
                <Title>Article1</Title>
                <URL>/France/Article1</URL>
                <Intro/>
                <Picture/>
                </Article>';

        $xml2 = '<Article id="a5147990-9191-4fdf-968b-6ae5f562cef3"><CreationDate>2020-05-19T13:17:11+02:00</CreationDate>
                <Type>standard</Type>
                <Title>Article1</Title>
                <URL></URL>
                <Intro/>
                <Picture/>
                </Article>';

        $dom = new \DOMDocument();
        $dom->loadXML($xml);

        $dom2 = new \DOMDocument();
        $dom2->loadXML($xml2);

        return [
            [
                new Article($xml, 'Article1.xml'),
                $dom->documentElement,
            ],
            [
                new Article($xml2, 'Article2.xml'),
                $dom2->documentElement,
            ],
        ];
    }
}
