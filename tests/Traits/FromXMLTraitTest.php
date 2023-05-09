<?php

namespace Traits;

use App\Traits\FromXMLTrait;
use App\ValueObject\ArticleValueObject;
use App\ValueObject\NonEmpty;
use DOMDocument;
use DOMElement;
use DOMNodeList;
use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\TestCase;

class FromXMLTraitTest extends TestCase
{
    use FromXMLTrait;

    public function testChildToNonEmptyReturnsNullIfChildNodeNotFound()
    {
        $mockDomElement = $this->createMock(DOMElement::class);
        $mockDomElement->expects($this->once())
            ->method('getElementsByTagName')
            ->with('test')
            ->willReturn(new DOMNodeList());

        $this->assertNull($this->childToNonEmpty($mockDomElement, 'test'));
    }

    public function testChildToNonEmptyReturnsNonEmptyObjectIfChildNodeFound()
    {
        $mockDomNodeList = $this->createMock(DOMNodeList::class);
        $mockDomNodeList->expects($this->once())
            ->method('item')
            ->with(0)
            ->willReturn('yes');

        $mockDomElement = $this->createMock(DOMElement::class);
        $mockDomElement->expects($this->once())
            ->method('getElementsByTagName')
            ->with('test')
            ->willReturn($mockDomNodeList);

        $this->assertInstanceOf(NonEmpty::class, $this->childToNonEmpty($mockDomElement, 'test'));
    }

    public function testToNonEmptyReturnsNonEmptyObject()
    {
        $result = $this->toNonEmpty('test');
        $this->assertInstanceOf(NonEmpty::class, $result);
        $this->assertEquals('test', $result->getValue());
    }
}