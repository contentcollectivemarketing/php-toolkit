<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\Text;

class TextTest extends TestCase
{
    public function testUuid()
    {
        $uuid = Text::uuid();

        self::assertEquals(36, strlen($uuid));
    }
}
