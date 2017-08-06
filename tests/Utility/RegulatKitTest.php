<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\RegularKit;

class RegulatKitTest extends TestCase
{
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
}
