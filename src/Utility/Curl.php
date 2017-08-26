<?php

namespace Toolkit\Utility;

use ErrorException;

/**
 * Class Curl
 *
 * @package Toolkit\Utility
 * @link    https://github.com/php-mod/curl
 */
class Curl
{
    /**
     * The cURL resource.
     *
     * @var resource
     */
    private $curl;

    /**
     * @var bool
     */
    public $errorStatus = false;

    /**
     * @var int
     */
    public $errorCode = 0;

    /**
     * @var string
     */
    public $errorMessage = '';

    /**
     * @var null
     */
    public $requestHeader = null;

    /**
     * @var array
     */
    public $responseHeader = [];

    /**
     * @var string
     */
    public $response;

    /**
     * CurlKit constructor.
     *
     * @throws \ErrorException
     * @see https://secure.php.net/manual/en/curl.installation.php
     */
    public function __construct()
    {
        if (!extension_loaded('curl')) {
            throw new ErrorException('Please make sure the cURL extension is loaded.');
        }

        $this->curl = curl_init();
        $this->setOption(CURLOPT_HEADER, true);
        $this->setOption(CURLINFO_HEADER_OUT, true);
        $this->setOption(CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Send request using get method.
     *
     * @param string $url
     * @param array  $data
     * @return $this
     */
    public function get(string $url, array $data = [])
    {
        if (count($data) > 0) {
            $url = $url . '?' . http_build_query($data);
        }

        $this->setOption(CURLOPT_URL, $url);
        $this->setOption(CURLOPT_HTTPGET, true);
        $this->execute();

        return $this;
    }

    /**
     * Send request using post method.
     *
     * @param string $url
     * @param array  $data
     * @return $this
     */
    public function post(string $url, array $data = [])
    {
        $this->setOption(CURLOPT_URL, $url);
        $this->process($data);
        $this->execute();

        return $this;
    }

    /**
     * Get information regarding a specific transfer.
     *
     * @param int $key
     * @return mixed
     * @see https://secure.php.net/manual/en/function.curl-getinfo.php
     */
    public function getOption(int $key)
    {
        return curl_getinfo($this->curl, $key);
    }

    /**
     * Set an option for a cURL transfer.
     *
     * @param int   $key
     * @param mixed $val
     * @return bool
     * @see https://secure.php.net/manual/en/function.curl-setopt.php
     */
    public function setOption($key, $val) : bool
    {
        return curl_setopt($this->curl, $key, $val);
    }

    /**
     * Close a cURL session.
     *
     * @return $this
     * @see http://php.net/manual/en/function.curl-close.php
     */
    public function close()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }

        return $this;
    }

    /**
     * CurlKit destructor.
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Perform a cURL session
     *
     * @return int
     * @see https://curl.haxx.se/libcurl/c/libcurl-errors.html
     */
    protected function execute() : int
    {
        $this->response = curl_exec($this->curl);
        $this->errorCode = curl_errno($this->curl);
        $this->errorMessage = curl_error($this->curl);

        $symbol = "\r\n\r\n";
        if (!(strpos($this->response, $symbol) === false)) {
            list($header, $this->response) = explode($symbol, $this->response, 2);
            while (strtolower(trim($header)) === 'http/1.1 100 continue') {
                list($header, $this->response) = explode($symbol, $this->response, 2);
            }
            $this->responseHeader = preg_split(
                '/\r\n/',
                $header,
                null,
                PREG_SPLIT_NO_EMPTY
            );
        }

        return $this->errorCode;
    }

    /**
     * The request data is processed when the POST method is called.
     *
     * @param mixed $data
     */
    protected function process(array $data = [])
    {
        $this->setOption(CURLOPT_POST, true);
        $this->setOption(CURLOPT_POSTFIELDS, http_build_query($data));
    }
}
