<?php

declare(strict_types=1);

class CurlClient
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function get(string $url)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($this->curl);

        if ($response === false) {
            throw new Exception("cURL Error: " . curl_error($this->curl));
        }

        return $response;
    }

    public function close()
    {
        curl_close($this->curl);
    }
}