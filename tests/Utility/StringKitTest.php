<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\StringKit;

class StringKitTest extends TestCase
{
    public function testStringLength()
    {
        $string = '我是中国人, 我来自伟大的中华人民共和国';

        self::assertEquals(20, StringKit::length($string));
    }
}
