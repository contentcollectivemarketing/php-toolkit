<?php

namespace Toolkit\Test;

use PHPUnit\Framework\TestCase;
use Toolkit\Text;

class TextTest extends TestCase
{
    public function testUuid()
    {
        $uuid = Text::uuid();

        self::assertEquals(36, strlen($uuid));
    }
}
