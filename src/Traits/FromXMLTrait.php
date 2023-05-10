<?php

namespace App\Traits;

use App\ValueObject\ArticleValueObject;
use App\ValueObject\NonEmpty;
use Webmozart\Assert\Assert;

trait FromXMLTrait
{
    public function transform(): string
    {
        return $this->childToNonEmpty((new ArticleValueObject($this))->transformToDOMElement(), self::NODENAME_URL)->getValue();
    }

    /**
     * Tries to return child node text value of the given element as a NonEmpty value object.
     */
    final public function childToNonEmpty(\DOMElement $root, string $name, string $type = NonEmpty::class): ?NonEmpty
    {
        if (null === $value = $this->childValue($root, $name)) {
            return null;
        }

        return $this->toNonEmpty($value, $type);
    }

    /**
     * Converts string value to NonEmpty value object.
     */
    final public function toNonEmpty(string $value, string $type = NonEmpty::class): NonEmpty
    {
        $isValid = is_a($type, NonEmpty::class, true);
        Assert::true($isValid, 'INVALID TYPE');

        return new NonEmpty($value);
    }

    private function childValue(\DOMElement $root, string $nodeName): ?string
    {
        $childNodes = $root->getElementsByTagName($nodeName);
        if (0 === $childNodes->length) {
            return null;
        }

        return $childNodes->item(0)->nodeValue;
    }
}
