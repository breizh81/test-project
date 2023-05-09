<?php

namespace App\Document;

use App\Traits\FromXMLTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="article")
 */
class Article implements ArticleInterface
{
    use FromXMLTrait;
    /**
     * @MongoDB\Id()
     */
    private string $id;

    /** @MongoDB\Field(type="string") */
    private string $xml;

    /** @MongoDB\Field(type="string") */
    private string $title;

    public function __construct(string $xml, string $title)
    {
        $this->xml = $xml;
        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getXml(): string
    {
        return $this->xml;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
