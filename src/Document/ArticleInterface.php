<?php

namespace App\Document;

interface ArticleInterface
{
    const NODENAME_URL = 'URL';

    public function getXml(): string;
}
