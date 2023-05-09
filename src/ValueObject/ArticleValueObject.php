<?php

namespace App\ValueObject;

use App\Document\ArticleInterface;
use DOMDocument;
use DOMElement;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArticleValueObject
{
    private ArticleInterface $article;

    function __construct(ArticleInterface $article)
    {
        $this->article = $article;
    }

    public function transformToDOMElement(): DOMElement
    {
        $dom = new DOMDocument();
        $dom->loadXML($this->article->getXml());

        return $dom->documentElement;
    }

}