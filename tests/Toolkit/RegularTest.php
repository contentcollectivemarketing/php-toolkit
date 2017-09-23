<?php

namespace Toolkit\Test;

use PHPUnit\Framework\TestCase;
use Toolkit\Regular;

class RegularTest extends TestCase
{
    public function testGet()
    {
        self::assertEquals('', Regular::get('test'));
    }

    public function testIsEmail()
    {
        self::assertTrue(Regular::isEmail('a_b90c-test.xyz@xyz-abc.com.cn'));
        self::assertFalse(Regular::isEmail('.b@test.xyz'));
    }

    public function testIsPhone()
    {
        self::assertTrue(Regular::isPhone('13319308888'));
        self::assertFalse(Regular::isPhone('12345678900'));
    }

    public function testIsChinese()
    {
        self::assertTrue(Regular::isChinese('向编程大牛们致敬'));
        self::assertFalse(Regular::isChinese('向 PHP 编程大牛们致敬'));
    }

    public function testIsChinaMobile()
    {
        self::assertTrue(Regular::isChinaMobile('13519198888'));
        self::assertFalse(Regular::isChinaMobile('13319198888'));
    }

    public function testIsChinaUnicom()
    {
        self::assertTrue(Regular::isChinaUnicom('17619198888'));
        self::assertFalse(Regular::isChinaUnicom('13519198888'));
    }

    public function testIsChinaTelecom()
    {
        self::assertTrue(Regular::isChinaTelecom('15319198888'));
        self::assertFalse(Regular::isChinaTelecom('18819198888'));
    }

    public function testIsIdCard()
    {
        self::assertTrue(Regular::isIdCard('43392330001231555X'));
        self::assertFalse(Regular::isIdCard('10010022001818111X'));
    }

    public function testIsQq()
    {
        self::assertTrue(Regular::isQq(11111));
        self::assertTrue(Regular::isQq(22222222222));
        self::assertFalse(Regular::isQq(012345));
        self::assertFalse(Regular::isQq(1000));
        self::assertFalse(Regular::isQq(123456789012));
    }

    public function testIsColorHexCode()
    {
        self::assertTrue(Regular::isColorHexCode('#Fba091'));
        self::assertFalse(Regular::isColorHexCode('#A6T7P2'));
    }

    public function testIsIpv4()
    {
        self::assertTrue(Regular::isIpv4('127.0.0.1'));
        self::assertTrue(Regular::isIpv4('0.0.0.0'));
        self::assertFalse(Regular::isIpv4('256.256.256.256'));
    }
}
