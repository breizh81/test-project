<?php

namespace ValueObject;

use App\Exception\ArticleException;
use App\ValueObject\NonEmpty;
use PHPUnit\Framework\TestCase;

class NonEmptyTest extends TestCase
{
    public function testException()
    {
        $this->expectException(ArticleException::class);
        $this->expectExceptionMessage('Aucune url n\'a été trouvé pour cet article.');
       new NonEmpty('');
    }

    public function testOk()
    {
        $object = new NonEmpty('test');

        self::assertEquals('test', $object->getValue());
    }
}
