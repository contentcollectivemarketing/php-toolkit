<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\NumberKit;

class NumberKitTest extends TestCase
{
    public function testCompare()
    {
        $expect = [
            true,
            true,
            true,
            true,
            true,
            true,
            false,
            true,
            true,
            true,
            true,
            false,
            true,
            true,
            true,
            true
        ];
        $actual = [
            NumberKit::compare(4, 4),
            NumberKit::compare(5, 5, 'eq'),
            NumberKit::compare(3.00, 3.001, '<'),
            NumberKit::compare(0.00001, 0.0001, 'lt'),
            NumberKit::compare(2.9966, 2.9966, '<='),
            NumberKit::compare(0.9966, 0.9966, 'lte'),
            NumberKit::compare(8.009, 8.007, 'lte'),
            NumberKit::compare('99.00002', '99.00001', '>'),
            NumberKit::compare(true, false, 'gt'),
            NumberKit::compare('0.01', '0.01', '>='),
            NumberKit::compare(false, false, 'gte'),
            NumberKit::compare(0.01, 0.0101, 'gte'),
            NumberKit::compare(9.009, '9.009', 'gte'),
            NumberKit::compare(1, 2, '<>'),
            NumberKit::compare(true, false, '!='),
            NumberKit::compare(100, '100.01', 'ne')
        ];
        self::assertSame($expect, $actual);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid operator.
     */
    public function testCompareException()
    {
        self::assertTrue(NumberKit::compare(1, 1, 'x'));
    }

    public function testToPhone()
    {
        $expect = [
            '111****2323',
            '112****4556',
            '133----9999',
            '144 hello world'
        ];
        $actual = [
            NumberKit::toPhone('11110142323'),
            NumberKit::toPhone(11223344556),
            NumberKit::toPhone('13399999999', '----', 2),
            NumberKit::toPhone('144 hello world')
        ];
        self::assertSame($expect, $actual);
    }

    public function testToNumber()
    {
        $expect = [
            '888888.00',
            '99.99',
            '0.4445',
            '99.45',
            '100.00'
        ];
        $actual = [
            NumberKit::toNumber(888888),
            NumberKit::toNumber(99.99),
            NumberKit::toNumber(0.444456789, 4),
            NumberKit::toNumber(99.45),
            NumberKit::toNumber(99.999)
        ];
        self::assertSame($expect, $actual);
    }

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
            NumberKit::toMoney(99.9956789)
        ];
        self::assertSame($expect, $actual);
    }

    public function testToBytes()
    {
        $expect = ['23.81 MB', '24 MB', '23.8061MB'];
        $actual = [
            NumberKit::toBytes(24962496),
            NumberKit::toBytes(24962496, 0, ' ', 1),
            NumberKit::toBytes(24962496, 4, '', 2),

        ];
        self::assertSame($expect, $actual);
    }
}
