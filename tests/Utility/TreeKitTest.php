<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\TreeKit;

class TreeKitTest extends TestCase
{
    private $data;

    protected function setUp()
    {
        $this->data = [
            ['id' => 10, 'name' => 'Name 10', 'pid' => 0],
            ['id' => 11, 'name' => 'Name 11', 'pid' => 0],
            ['id' => 12, 'name' => 'Name 12', 'pid' => 0],
            ['id' => 13, 'name' => 'Name 13', 'pid' => 10],
            ['id' => 14, 'name' => 'Name 14', 'pid' => 10],
            ['id' => 15, 'name' => 'Name 15', 'pid' => 11],
            ['id' => 16, 'name' => 'Name 16', 'pid' => 11],
            ['id' => 17, 'name' => 'Name 17', 'pid' => 12],
            ['id' => 18, 'name' => 'Name 18', 'pid' => 12],
            ['id' => 19, 'name' => 'Name 19', 'pid' => 13],
            ['id' => 20, 'name' => 'Name 20', 'pid' => 13],
            ['id' => 21, 'name' => 'Name 21', 'pid' => 15],
            ['id' => 22, 'name' => 'Name 22', 'pid' => 17],
            ['id' => 23, 'name' => 'Name 23', 'pid' => 19],
        ];
    }

    public function testMakeTree()
    {
        $config = [
            'id'       => 'id',
            'parentId' => 'pid',
            'children' => 'child'
        ];
        TreeKit::setConfig($config);
        $array = $this->data;
        $expect = TreeKit::buildTree($array);
        $actual = TreeKit::makeTree($array);
        self::assertSame($expect, $actual);
    }
}
