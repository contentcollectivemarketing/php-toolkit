<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\StringKit;

class StringKitTest extends TestCase
{
    private $string;

    protected function setUp()
    {
        $this->string = '我是中国人，我来自伟大的中华人民共和国，一个神奇的国度。';
    }

    public function testToUpper()
    {
        $expect = 'HELLO WORLD!';
        $actual = StringKit::toUpper('hello world!');
        self::assertEquals($expect, $actual);
    }

    public function testToLower()
    {
        $expect = 'this is a string.';
        $actual = StringKit::toLower('THIS IS A STRING.');
        self::assertEquals($expect, $actual);
    }

    public function testLengthString()
    {
        $actual = StringKit::length($this->string);
        self::assertEquals(28, $actual);
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
        self::assertEmpty(StringKit::beforeOfFirst($this->string, ','));
    }

    public function testBeforeOfLastString()
    {
        $expect = '我是中国人，我来自伟大的中华人民共和国';
        $actual = StringKit::beforeOfLast($this->string, '，');
        self::assertEquals($expect, $actual);
        self::assertEmpty(StringKit::beforeOfLast($this->string, ','));
    }

    public function testAfterOfFirstString()
    {
        $expect = '我来自伟大的中华人民共和国，一个神奇的国度。';
        $actual = StringKit::afterOfFirst($this->string, '，');
        self::assertEquals($expect, $actual);
        self::assertEmpty(StringKit::afterOfFirst($this->string, ','));
    }

    public function testAfterOfLastString()
    {
        $expect = '一个神奇的国度。';
        $actual = StringKit::afterOfLast($this->string, '，');
        self::assertEquals($expect, $actual);
        self::assertEmpty(StringKit::afterOfLast($this->string, ','));
    }
}
