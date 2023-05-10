<?php

namespace App\Document;

interface ArticleInterface
{
    public const NODENAME_URL = 'URL';

    public function getXml(): string;
}
