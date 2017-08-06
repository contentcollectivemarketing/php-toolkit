<?php

namespace Toolkit\Test\Utility;

use PHPUnit\Framework\TestCase;
use Toolkit\Utility\CurlKit;

class CurlKitTest extends TestCase
{
    const TEST_URI = 'http://testing.duapp.com/server.php';

    protected $Curl;

    protected function setUp()
    {
        $this->Curl = new CurlKit();
        $this->Curl->setOption(CURLOPT_SSL_VERIFYPEER, false);
        $this->Curl->setOption(CURLOPT_SSL_VERIFYHOST, false);
    }

    public function testExtensionLoaded()
    {
        self::assertTrue(extension_loaded('curl'));
    }

    public function testGet()
    {
        $this->Curl->get(self::TEST_URI, [
            'key' => 'REQUEST_METHOD',
            'val' => 'server'
        ]);
        $actual = $this->Curl->response;
        $this->Curl->close();
        $this->assertEquals('GET', $actual);
    }

    public function testPost()
    {
        $this->Curl->post(self::TEST_URI, [
            'key' => 'REQUEST_METHOD',
            'val' => 'server'
        ]);
        $this->Curl->__destruct();
        $this->assertEquals('POST', $this->Curl->response);
    }
}
