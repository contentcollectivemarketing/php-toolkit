<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\ArrayKit;

class ArrayKitTest extends TestCase
{
    public function testGetFromArray()
    {
        $array = [
            'a' => 'hello',
            'b' => '',
            'c' => false,
            'd' => null
        ];
        self::assertEquals('hello', ArrayKit::get($array, 'a'));
        self::assertEquals('', ArrayKit::get($array, 'b'));
        self::assertEquals(false, ArrayKit::get($array, 'c'));
        self::assertEquals(null, ArrayKit::get($array, 'd'));
        self::assertEquals(null, ArrayKit::get($array, 'e'));
        self::assertEquals(0, ArrayKit::get($array, 'f', 0));
        self::assertEquals($array, ArrayKit::get($array, null));
    }

    public function testSetFromArray()
    {
        $expect = $actual = [];
        $expect = ArrayKit::set($expect, 'a', null);
        $actual['a'] = null;
        self::assertEquals($expect, $actual);

        $expect = ArrayKit::set($expect, null);
        self::assertEquals($expect, $actual);
    }

    public function testAddFromArray()
    {
        $expect = $actual = [];
        $expect = ArrayKit::add($expect, 0, 'hello');
        $actual[] = 'hello';
        self::assertEquals($expect, $actual);

        $expect = ArrayKit::add($expect, 1);
        $actual[] = null;
        self::assertEquals($expect, $actual);
    }

    public function testMapFromArray()
    {
        $array = [
            ['id' => '1', 'name' => 'a', 'group' => 'x'],
            ['id' => '2', 'name' => 'b', 'group' => 'x'],
            ['id' => '3', 'name' => 'c', 'group' => 'y'],
        ];
        $expect = ['1' => 'a', '2' => 'b', '3' => 'c'];
        $actual = ArrayKit::map($array, 'id', 'name');
        self::assertSame($expect, $actual);

        $expect = ['x' => ['1' => 'a', '2' => 'b'], 'y' => ['3' => 'c']];
        $actual = ArrayKit::map($array, 'id', 'name', 'group');
        self::assertSame($expect, $actual);
    }

    public function testTrimFromArray()
    {
        $actual[] = ' hello ';
        $actual = ArrayKit::trim($actual);
        self::assertEquals(['hello'], $actual);

        $actual[] = [' a ', ' b '];
        $actual = ArrayKit::trim($actual);
        self::assertEquals(['hello', ['a', 'b']], $actual);
    }

    public function testDivideFromArray()
    {
        $actual = ['x' => 'a', 'y' => 'b', 'z' => 'c', 'a', 'b'];
        $expect = [['x', 'y', 'z', 0, 1], ['a', 'b', 'c', 'a', 'b']];

        $actual = ArrayKit::divide($actual);
        self::assertSame($expect, $actual);
    }
}
