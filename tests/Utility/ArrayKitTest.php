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
}
