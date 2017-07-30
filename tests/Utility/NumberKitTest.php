<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\NumberKit;

class NumberKitTest extends TestCase
{
    public function testToBytes()
    {
        $expect = ['23.81 MB', '24 MB', '23.8061MB'];
        $actual = [
            NumberKit::toBytes(24962496),
            NumberKit::toBytes(24962496, 0, ' ', 2),
            NumberKit::toBytes(24962496, 4, '', 3),

        ];
        self::assertSame($expect, $actual);
    }
}
