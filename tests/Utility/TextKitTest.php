<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\TextKit;

class TextKitTest extends TestCase
{
    public function testUuid()
    {
        $uuid = TextKit::uuid();

        self::assertEquals(36, strlen($uuid));
    }
}
