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
        $c = 'hello world_hello php';
        $expect = [
            'helloWorldHelloPhp',
            'helloWorldHelloPhp',
            'helloWorldHelloPhp',
        ];
        $actual = [
            InflectorKit::camelize($a),
            InflectorKit::camelize($b),
            InflectorKit::camelize($c)
        ];

        self::assertEquals($expect, $actual);
    }

    public function testHumanize()
    {
        $a = InflectorKit::humanize('this_is_a_test_script');
        $b = InflectorKit::humanize('this*is*my*test*script', '*');
        $c = InflectorKit::humanize('Hello Everybody');
        $expect = [
            'this is a test script',
            'this is my test script',
            'hello everybody'
        ];
        $actual = [$a, $b, $c];
        self::assertEquals($expect, $actual);
    }
}
