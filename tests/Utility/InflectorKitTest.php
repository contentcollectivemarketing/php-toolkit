<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\InflectorKit;

class InflectorKitTest extends TestCase
{
    public function testCamelize()
    {
        $a = 'hello World Hello Php';
        $b = 'hello_world_hello_php';
        $c = 'Replace Temp with Query';
        $expect = [
            'helloWorldHelloPhp',
            'helloWorldHelloPhp',
            'replaceTempWithQuery',
        ];
        $actual = [
            InflectorKit::camelize($a),
            InflectorKit::camelize($b),
            InflectorKit::camelize($c)
        ];

        self::assertSame($expect, $actual);
    }

    public function testHumanize()
    {
        $expect = [
            'this is a test script',
            'this is my test script',
            'hello everybody'
        ];
        $actual = [
            InflectorKit::humanize('this_is_a_test_script'),
            InflectorKit::humanize('this*is*my*test*script', '*'),
            InflectorKit::humanize('Hello Everybody')
        ];
        self::assertSame($expect, $actual);
    }
}
