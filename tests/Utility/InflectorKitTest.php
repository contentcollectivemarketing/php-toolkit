<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\InflectorKit;

class InflectorKitTest extends TestCase
{
    public function testCamelize()
    {
        $a = InflectorKit::camelize('hello World Hello Php');
        $b = InflectorKit::camelize('hello_world_hello_php');
        $c = InflectorKit::camelize('hello world_hello php');
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
}
