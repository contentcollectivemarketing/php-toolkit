<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\ArrayKit;

class ArrayKitTest extends TestCase
{
    public function testGet()
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

    public function testSet()
    {
        $expect = $actual = [];
        $expect = ArrayKit::set($expect, 'a', null);
        $actual['a'] = null;
        self::assertEquals($expect, $actual);

        $expect = ArrayKit::set($expect, null);
        self::assertEquals($expect, $actual);
    }

    public function testAdd()
    {
        $expect = $actual = [];
        $expect = ArrayKit::add($expect, 0, 'hello');
        $actual[] = 'hello';
        self::assertEquals($expect, $actual);

        $expect = ArrayKit::add($expect, 1);
        $actual[] = null;
        self::assertEquals($expect, $actual);
    }
}
