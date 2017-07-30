<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\Arr;

class ArrTest extends TestCase
{
    public function testGetFromArray()
    {
        $array = [
            'a' => 'hello',
            'b' => '',
            'c' => false,
            'd' => null
        ];
        self::assertEquals('hello', Arr::get($array, 'a'));
        self::assertEquals('', Arr::get($array, 'b'));
        self::assertEquals(false, Arr::get($array, 'c'));
        self::assertEquals(null, Arr::get($array, 'd'));
        self::assertEquals(null, Arr::get($array, 'e'));
        self::assertEquals(0, Arr::get($array, 'f', 0));
        self::assertEquals($array, Arr::get($array, null));
    }

    public function testSetFromArray()
    {
        $expect = $actual = [];
        $expect = Arr::set($expect, 'a', null);
        $actual['a'] = null;
        self::assertEquals($expect, $actual);

        $expect = Arr::set($expect, null);
        self::assertEquals($expect, $actual);
    }

    public function testAddFromArray()
    {
        $expect = $actual = [];
        $expect = Arr::add($expect, 0, 'hello');
        $actual[] = 'hello';
        self::assertEquals($expect, $actual);

        $expect = Arr::add($expect, 1);
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
        $actual = Arr::map($array, 'id', 'name');
        self::assertSame($expect, $actual);

        $expect = ['x' => ['1' => 'a', '2' => 'b'], 'y' => ['3' => 'c']];
        $actual = Arr::map($array, 'id', 'name', 'group');
        self::assertSame($expect, $actual);
    }

    public function testOnlyFromArray()
    {
        $actual = ['id' => '1001', 'name' => 'hello', 'age' => 18];
        self::assertSame(['id' => '1001'], Arr::only($actual, ['id']));
        self::assertSame(['age' => 18], Arr::only($actual, 'age'));
    }

    public function testTrimFromArray()
    {
        $actual[] = ' hello ';
        $actual = Arr::trim($actual);
        self::assertEquals(['hello'], $actual);

        $actual[] = [' a ', ' b '];
        $actual = Arr::trim($actual);
        self::assertEquals(['hello', ['a', 'b']], $actual);
    }

    public function testDivideFromArray()
    {
        $actual = ['x' => 'a', 'y' => 'b', 'z' => 'c', 'a', 'b'];
        $expect = [['x', 'y', 'z', 0, 1], ['a', 'b', 'c', 'a', 'b']];

        $actual = Arr::divide($actual);
        self::assertSame($expect, $actual);
    }
}
