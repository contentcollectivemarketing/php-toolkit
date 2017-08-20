<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\InflectorKit;

class InflectorKitTest extends TestCase
{
    public function testPluralize()
    {
        $expect = [
            'children',
            'women',
            'oxen',
            'queries',
        ];
        $actual = [
            InflectorKit::pluralize('child'),
            InflectorKit::pluralize('woman'),
            InflectorKit::pluralize('ox'),
            InflectorKit::pluralize('query'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testSingularize()
    {
        $expect = [
            'apple',
            'child',
            'sex',
            'man',
        ];
        $actual = [
            InflectorKit::singularize('apples'),
            InflectorKit::singularize('children'),
            InflectorKit::singularize('sexes'),
            InflectorKit::singularize('men'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testCamelize()
    {
        $a = 'hello World Hello Php';
        $b = 'hello_world_hello_php';
        $c = 'Replace Temp with Query';
        $expect = [
            'HelloWorldHelloPhp',
            'HelloWorldHelloPhp',
            'ReplaceTempWithQuery',
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
            'This Is A Test Script',
            'This Is My Test Script',
            'Hello Everybody'
        ];
        $actual = [
            InflectorKit::humanize('this_is_a_test_script'),
            InflectorKit::humanize('this*is*my*test*script', '*'),
            InflectorKit::humanize('Hello Everybody')
        ];
        self::assertSame($expect, $actual);
    }

    public function testClassify()
    {
        $expect = [
            'SystemSetting',
            'User',
            'UserProfileSetting',
        ];
        $actual = [
            InflectorKit::classify('system_settings'),
            InflectorKit::classify('Users'),
            InflectorKit::classify('user_profile_settings'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testDelimit()
    {
        $expect = [
            'to_upper_case',
            'to|lower|case',
        ];
        $actual = [
            InflectorKit::delimit('ToUpperCase'),
            InflectorKit::delimit('ToLowerCase', '|')
        ];
        self::assertSame($expect, $actual);
    }

    public function testUnderscore()
    {
        $expect = [
            'object_to_array',
            'string_to_array',
        ];
        $actual = [
            InflectorKit::underscore('objectToArray'),
            InflectorKit::underscore('stringToArray'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testDasherize()
    {
        $expect = [
            'array-to-string',
            'system-settings',
        ];
        $actual = [
            InflectorKit::dasherize('ArrayToString'),
            InflectorKit::dasherize('system_settings'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testTableize()
    {
        $expect = [
            'products',
            'user_profile_settings',
        ];
        $actual = [
            InflectorKit::tableize('Product'),
            InflectorKit::tableize('UserProfileSetting'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testVariable()
    {
        $expect = [
            'userProfile',
            'curl_helper',
            'usePHPVariableToQuery',
        ];
        $actual = [
            InflectorKit::variable('UserProfile'),
            InflectorKit::variable('curl_helper'),
            InflectorKit::variable('UsePHPVariableToQuery'),
        ];
        self::assertSame($expect, $actual);
    }
}
