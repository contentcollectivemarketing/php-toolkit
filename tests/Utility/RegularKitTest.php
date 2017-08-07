<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\RegularKit;

class RegularKitTest extends TestCase
{
    public function testGet()
    {
        self::assertEquals('', RegularKit::get('test'));
    }

    public function testIsEmail()
    {
        self::assertTrue(RegularKit::isEmail('a_b90c-test.xyz@xyz-abc.com.cn'));
        self::assertFalse(RegularKit::isEmail('.b@test.xyz'));
    }

    public function testIsPhone()
    {
        self::assertTrue(RegularKit::isPhone('13319308888'));
        self::assertFalse(RegularKit::isPhone('12345678900'));
    }

    public function testIsChinaMobile()
    {
        self::assertTrue(RegularKit::isChinaMobile('13519198888'));
        self::assertFalse(RegularKit::isChinaMobile('13319198888'));
    }

    public function testIsChinaUnicom()
    {
        self::assertTrue(RegularKit::isChinaUnicom('17619198888'));
        self::assertFalse(RegularKit::isChinaUnicom('13519198888'));
    }

    public function testIsChinaTelecom()
    {
        self::assertTrue(RegularKit::isChinaTelecom('15319198888'));
        self::assertFalse(RegularKit::isChinaTelecom('18819198888'));
    }

    public function testIsIdCard()
    {
        self::assertTrue(RegularKit::isIdCard('43392330001231555X'));
        self::assertFalse(RegularKit::isIdCard('10010022001818111X'));
    }

    public function testIsQq()
    {
        self::assertTrue(RegularKit::isQq(11111));
        self::assertTrue(RegularKit::isQq(22222222222));
        self::assertFalse(RegularKit::isQq(012345));
        self::assertFalse(RegularKit::isQq(1000));
        self::assertFalse(RegularKit::isQq(123456789012));
    }

    public function testIsIpv4()
    {
        self::assertTrue(RegularKit::isIpv4('127.0.0.1'));
        self::assertTrue(RegularKit::isIpv4('0.0.0.0'));
        self::assertFalse(RegularKit::isIpv4('256.256.256.256'));
    }
}
