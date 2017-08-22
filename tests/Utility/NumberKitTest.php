<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\NumberKit;

class NumberKitTest extends TestCase
{
    public function testCompare()
    {
        self::assertTrue(NumberKit::compare(4, 4));
        self::assertTrue(NumberKit::compare(5, 5, 'eq'));
        self::assertTrue(NumberKit::compare(3.00, 3.001, '<'));
        self::assertTrue(NumberKit::compare(0.00001, 0.0001, 'lt'));
        self::assertTrue(NumberKit::compare(2.9966, 2.9966, '<='));
        self::assertTrue(NumberKit::compare(0.9966, 0.9966, 'lte'));
        self::assertFalse(NumberKit::compare(8.009, 8.007, 'lte'));
        self::assertTrue(NumberKit::compare('99.00002', '99.00001', '>'));
        self::assertFalse(NumberKit::compare(23.23, 24.24, '>'));
        self::assertTrue(NumberKit::compare(true, false, 'gt'));
        self::assertTrue(NumberKit::compare('0.01', '0.01', '>='));
        self::assertTrue(NumberKit::compare(false, false, 'gte'));
        self::assertFalse(NumberKit::compare(0.01, 0.0101, 'gte'));
        self::assertTrue(NumberKit::compare(9.009, '9.009', 'gte'));
        self::assertTrue(NumberKit::compare(1, 2, '<>'));
        self::assertTrue(NumberKit::compare(true, false, '!='));
        self::assertTrue(NumberKit::compare(100, '100.01', 'ne'));
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

    public function testToDecimal()
    {
        $expect = [
            '9,999,999,999.00',
            '100.0',
            '0.4444',
            '99.45',
            '999,999.996',
            '8,888.8889',
            '4.444,44445',
        ];
        $actual = [
            NumberKit::toDecimal(9999999999),
            NumberKit::toDecimal(99.99, 1),
            NumberKit::toDecimal(0.444444445, 4),
            NumberKit::toDecimal(99.4456789),
            NumberKit::toDecimal(999999.9956789, 3),
            NumberKit::toDecimal(8888.8888999, 4, 'en-US'),
            NumberKit::toDecimal(4444.4444455555, 5, 'it-IT'),
        ];
        self::assertEquals($expect, $actual);
    }

    public function testToBytes()
    {
        $expect = ['23.81 MB', '24-MB', '23.8061MB', '1 TB'];
        $actual = [
            NumberKit::toBytes(24962496),
            NumberKit::toBytes(24962496, 0, '-'),
            NumberKit::toBytes(24962496, 4, '', 2),
            NumberKit::toBytes(1099511627776)
        ];
        self::assertSame($expect, $actual);
    }
}
