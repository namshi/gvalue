<?php

namespace Namshi\Test\Integration;

use Namshi\Gvalue;

class GvalueTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Namshi\Exception\DocumentRetrievalException
     */
    public function testConvertingANonExistingDocument()
    {
        $gvalue = new Gvalue();

        $this->assertNull($gvalue->getDocument(123));
    }

    public function testConvertingADocument()
    {
        $gvalue = new Gvalue();
        $content = array(1=>2, '123' => '456');

        $this->assertEquals($content, $gvalue->getDocument('0Au4X4OwTcvrSdHNTajVtaXp0NkhnYVpwc1JKTU5GWFE'));
    }

    public function testConvertingALongerDocument()
    {
        $gvalue = new Gvalue();
        $content = array(
            'aaa' => 'bbbb',
            12345678 => '67876678876',
            'alessandro' => 'nadalin',
            'i like' => 'pears',
            'i love' => 'nodejs',
            'i prefer' => 'APIs',
            'i code in' => 'php'
        );

        $this->assertEquals($content, $gvalue->getDocument('0Au4X4OwTcvrSdG5oZkFXMXM5SUl4YVF5bDV2NmZiSmc'));
    }
}