<?php

namespace Naroat\VoiceApi;

use Naroat\VoiceApi\Base;
use Naroat\VoiceApi\Contract\DriverInterface;

class Voice
{
    public array $config;

    public DriverInterface $driver;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function driver(string $name, array $config = [])
    {
        if (!$config) {
            $config = $this->config;
        }
        $this->driver = Factory::make($name, $config);
        return $this->driver;
    }

    public static function __callStatic($method, $arguments)
    {
        $app = new self(...$arguments);
        return $app->driver($method);
    }
}