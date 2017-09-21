<?php

namespace Toolkit\Test;

use PHPUnit\Framework\TestCase;
use Toolkit\Inflector;

class InflectorTest extends TestCase
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
            Inflector::pluralize('child'),
            Inflector::pluralize('woman'),
            Inflector::pluralize('ox'),
            Inflector::pluralize('query'),
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
            Inflector::singularize('apples'),
            Inflector::singularize('children'),
            Inflector::singularize('sexes'),
            Inflector::singularize('men'),
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
            Inflector::camelize($a),
            Inflector::camelize($b),
            Inflector::camelize($c)
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
            Inflector::humanize('this_is_a_test_script'),
            Inflector::humanize('this*is*my*test*script', '*'),
            Inflector::humanize('Hello Everybody')
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
            Inflector::classify('system_settings'),
            Inflector::classify('Users'),
            Inflector::classify('user_profile_settings'),
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
            Inflector::delimit('ToUpperCase'),
            Inflector::delimit('ToLowerCase', '|')
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
            Inflector::underscore('objectToArray'),
            Inflector::underscore('stringToArray'),
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
            Inflector::dasherize('ArrayToString'),
            Inflector::dasherize('system_settings'),
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
            Inflector::tableize('Product'),
            Inflector::tableize('UserProfileSetting'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testVariable()
    {
        $expect = [
            'userProfile',
            'curl_Helper',
            'usePHPVariableToQuery',
        ];
        $actual = [
            Inflector::variable('UserProfile'),
            Inflector::variable('Curl_Helper'),
            Inflector::variable('UsePHPVariableToQuery'),
        ];
        self::assertSame($expect, $actual);
    }

    public function testOrdinalize()
    {
        $expect = [
            '1st',
            '2nd',
            '3 rd',
        ];
        $actual = [
            Inflector::ordinalize(1),
            Inflector::ordinalize(2),
            Inflector::ordinalize(3, ' '),
        ];
        self::assertEquals($expect, $actual);
    }
}
