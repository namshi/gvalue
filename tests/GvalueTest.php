<?php

namespace Namshi\Test;

use Namshi\Gvalue;

class GvalueTest  extends \PHPUnit_Framework_TestCase
{
    public function testRetrievingADocument()
    {
        $gvalue = new GvalueStub();
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

class GvalueStub extends Gvalue
{
    protected function getDocumentContent($id)
    {
        return file_get_contents(__DIR__ . '/stub/' . $id . '.stub');
    }
}