<?php

namespace Naroat\VoiceApi;


use GuzzleHttp\Client as GuzzleClient;

abstract class Base
{
    public $httpClient;

    public function __construct()
    {
        $this->httpClient = new GuzzleClient();
    }

    /**
     * header
     *
     * @param array $headers
     * @return array|string[]
     */
    public function header(array $headers = []): array
    {
        $header = [
            'Content-Type' => 'application/json'
        ];
        if (!empty($headers)) {
            $header = $headers;
        }
        return $header;
    }
}
