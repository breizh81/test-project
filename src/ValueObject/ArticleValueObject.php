<?php

namespace App\ValueObject;

use App\Document\ArticleInterface;

class ArticleValueObject
{
    public function __construct(private readonly ArticleInterface $article)
    {
    }

    public function transformToDOMElement(): \DOMElement
    {
        $dom = new \DOMDocument();
        $dom->loadXML($this->article->getXml());

        return $dom->documentElement;
    }
}
