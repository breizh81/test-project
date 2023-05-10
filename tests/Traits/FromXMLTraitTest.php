<?php

namespace Traits;

use App\Traits\FromXMLTrait;
use App\ValueObject\NonEmpty;
use DOMDocument;
use DOMElement;
use DOMNodeList;
use PHPUnit\Framework\TestCase;

class FromXMLTraitTest extends TestCase
{
    use FromXMLTrait;

    public function testChildToNonEmptyReturnsNullIfChildNodeNotFound(): void
    {
        $mockDomElement = $this->createMock(DOMElement::class);
        $mockDomElement->expects($this->once())
            ->method('getElementsByTagName')
            ->with('test')
            ->willReturn(new DOMNodeList());

        $this->assertNull($this->childToNonEmpty($mockDomElement, 'test'));
    }

    public function testChildToNonEmptyReturnsNonEmptyObjectIfChildNodeFound(): void
    {
        $doc = new DOMDocument();
        $doc->loadXML('<article><test>content</test></article>');

        $this->assertInstanceOf(NonEmpty::class, $this->childToNonEmpty($doc->documentElement, 'test'));
    }

    public function testToNonEmptyReturnsNonEmptyObject(): void
    {
        $result = $this->toNonEmpty('test');
        $this->assertInstanceOf(NonEmpty::class, $result);
        $this->assertEquals('test', $result->getValue());
    }
}
