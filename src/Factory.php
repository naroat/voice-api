<?php

namespace Naroat\VoiceApi;

use Naroat\VoiceApi\Contract\DriverInterface;
use Naroat\VoiceApi\Exception\ErrorException;

final class Factory
{
    /**
     * @param string $name
     * @param array $config
     * @return mixed
     * @throws ErrorException
     */
    public static function make(string $name, array $config): DriverInterface
    {
        $driver = __NAMESPACE__ . '\\Driver\\' . ucfirst($name);

        if (!class_exists($driver)) {
            throw new ErrorException("driver [{$name}] not exist");
        }

        return new $driver($config);
    }
}