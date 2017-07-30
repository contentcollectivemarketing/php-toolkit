<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\Num;

class NumTest extends TestCase
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
            Num::toMoney(9999999999),
            Num::toMoney(99.99),
            Num::toMoney(0.444444445, 4),
            Num::toMoney(99.4456789),
            Num::toMoney(99.9956789),
        ];
        self::assertSame($expect, $actual);
    }

    public function testToBytes()
    {
        $expect = ['23.81 MB', '24 MB', '23.8061MB'];
        $actual = [
            Num::toBytes(24962496),
            Num::toBytes(24962496, 0, ' ', 2),
            Num::toBytes(24962496, 4, '', 3),

        ];
        self::assertSame($expect, $actual);
    }
}
