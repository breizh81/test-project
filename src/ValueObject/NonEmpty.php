<?php

namespace App\ValueObject;

use App\Exception\ArticleException;

class NonEmpty
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new ArticleException('Aucune url n\'a été trouvé pour cet article.');
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}