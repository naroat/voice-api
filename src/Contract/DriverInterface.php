<?php

namespace Naroat\VoiceApi\Contract;

use Psr\Http\Message\ResponseInterface;

interface DriverInterface
{
    public function tts(): ResponseInterface;
}