<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\Str;

class StrTest extends TestCase
{
    private $string;

    protected function setUp()
    {
        $this->string = '我是中国人，我来自伟大的中华人民共和国，一个神奇的国度。';
    }

    public function testToUpper()
    {
        $expect = 'HELLO WORLD!';
        $actual = Str::toUpper('hello world!');
        self::assertEquals($expect, $actual);
    }

    public function testToLower()
    {
        $expect = 'this is a string.';
        $actual = Str::toLower('THIS IS A STRING.');
        self::assertEquals($expect, $actual);
    }

    public function testLengthString()
    {
        $actual = Str::length($this->string);
        self::assertEquals(28, $actual);
    }

    public function testSubString()
    {
        $expect = '我是中国人，我来自';
        $actual = Str::substr($this->string, 0, 9);

        self::assertEquals($expect, $actual);
        self::assertEquals($this->string, Str::substr($this->string, 0));
    }

    public function testTruncateString()
    {
        $expect = Str::substr($this->string, 0, 15) . '...';
        $actual = Str::truncate($this->string);

        self::assertEquals($expect, $actual);
    }

    public function testBeforeOfFirstString()
    {
        $expect = '我是中国人';
        $actual = Str::beforeOfFirst($this->string, '，');

        self::assertEquals($expect, $actual);
        self::assertEmpty(Str::beforeOfFirst($this->string, ','));
    }

    public function testBeforeOfLastString()
    {
        $expect = '我是中国人，我来自伟大的中华人民共和国';
        $actual = Str::beforeOfLast($this->string, '，');
        self::assertEquals($expect, $actual);
        self::assertEmpty(Str::beforeOfLast($this->string, ','));
    }

    public function testAfterOfFirstString()
    {
        $expect = '我来自伟大的中华人民共和国，一个神奇的国度。';
        $actual = Str::afterOfFirst($this->string, '，');
        self::assertEquals($expect, $actual);
        self::assertEmpty(Str::afterOfFirst($this->string, ','));
    }

    public function testAfterOfLastString()
    {
        $expect = '一个神奇的国度。';
        $actual = Str::afterOfLast($this->string, '，');
        self::assertEquals($expect, $actual);
        self::assertEmpty(Str::afterOfLast($this->string, ','));
    }
}
