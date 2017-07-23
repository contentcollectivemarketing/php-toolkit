<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\StringKit;

class StringKitTest extends TestCase
{
    private $string;

    protected function setUp()
    {
        $this->string = '我是中国人，我来自伟大的中华人民共和国';
    }

    public function testLengthString()
    {
        $actual = StringKit::length($this->string);
        self::assertEquals(19, $actual);
    }

    public function testSubString()
    {
        $expect = '我是中国人，我来自';
        $actual = StringKit::substr($this->string, 0, 9);

        self::assertEquals($expect, $actual);
        self::assertEquals($this->string, StringKit::substr($this->string, 0));
    }

    public function testTruncateString()
    {
        $expect = StringKit::substr($this->string, 0, 15) . '...';
        $actual = StringKit::truncate($this->string);

        self::assertEquals($expect, $actual);
    }

    public function testBeforeOfFirstString()
    {
        $expect = '我是中国人';
        $actual = StringKit::beforeOfFirst($this->string, '，');

        self::assertEquals($expect, $actual);
    }

    public function testAfterOfFirstString()
    {
        $expect = '我来自伟大的中华人民共和国';
        $actual = StringKit::afterOfFirst($this->string, '，');
        self::assertEquals($expect, $actual);

        $expect = $this->string;
        $actual = StringKit::afterOfFirst($this->string, ',');
        self::assertEquals($expect, $actual);

    }
}
