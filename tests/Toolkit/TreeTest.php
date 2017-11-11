<?php

namespace Toolkit\Test;

use PHPUnit\Framework\TestCase;
use Toolkit\Tree;

class TreeTest extends TestCase
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
            'children' => 'child',
        ];
        Tree::setConfig($config);
        $a = $b = $c = $this->data;
        $x = Tree::getTree($a);
        $y = Tree::makeTree($c);
        $z = Tree::buildTree($b);
        self::assertSame($x, $y);
        self::assertSame($x, $z);
        self::assertSame($y, $z);
    }

    public function testGetTreeId()
    {
        $config = [
            'id'       => 'id',
            'parentId' => 'pid',
            'children' => 'child',
        ];
        Tree::setConfig($config);
        $expect = [
            10 => [
                13 => [
                    19 => [23],
                    20 => [],
                ],
                14 => [],
            ],
            11 => [
                15 => [21],
                16 => [],
            ],
            12 => [
                17 => [22],
                18 => [],
            ],
        ];
        $data = $this->data;
        $array = Tree::makeTree($data);
        $actual = Tree::getTreeId($array);
        self::assertSame($expect, $actual);
    }
}
