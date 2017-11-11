<?php

namespace Toolkit\Test;

use PHPUnit\Framework\TestCase;
use Toolkit\Curl;

class CurlTest extends TestCase
{
    /**
     * This is the remote script request path.
     */
    const TEST_URI = 'http://testing.duapp.com/server.php';

    protected $Curl;

    protected function setUp()
    {
        if (!extension_loaded('curl')) {
            self::markTestSkipped('The CURL extension is not available.');
        }
        $this->Curl = new Curl();
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
            'val' => 'server',
        ]);
        $actual = $this->Curl->response;
        $this->Curl->close();
        $this->assertEquals('GET', $actual);
    }

    public function testPost()
    {
        $this->Curl->post(self::TEST_URI, [
            'key' => 'REQUEST_METHOD',
            'val' => 'server',
        ]);
        $this->Curl->__destruct();
        $this->assertEquals('POST', $this->Curl->response);
    }
}
