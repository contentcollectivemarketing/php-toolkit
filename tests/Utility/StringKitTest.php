<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\StringKit;

class StringKitTest extends TestCase
{
    private $string;

    protected function setUp()
    {
        $this->string = '我是中国人, 我来自伟大的中华人民共和国';
    }

    public function testLengthString()
    {
        $actual = StringKit::length($this->string);
        self::assertEquals(20, $actual);
    }

    public function testSubString()
    {
        $expect = '我是中国人, 我来自';
        $actual = StringKit::substr($this->string, 0, 10);

        self::assertEquals($expect, $actual);
    }
}
