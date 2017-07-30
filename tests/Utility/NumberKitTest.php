<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\NumberKit;

class NumberKitTest extends TestCase
{
    public function testToMoney()
    {
        $expect = [
            '￥9,999,999,999.00',
            '￥99.99',
            '￥0.4444',
            '￥99.45',
            '￥100.00'
        ];
        $actual = [
            NumberKit::toMoney(9999999999),
            NumberKit::toMoney(99.99),
            NumberKit::toMoney(0.444444445, 4),
            NumberKit::toMoney(99.4456789),
            NumberKit::toMoney(99.9956789),
        ];
        self::assertSame($expect, $actual);
    }

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
