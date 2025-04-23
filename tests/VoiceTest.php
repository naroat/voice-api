<?php

namespace Naroat\VoiceApi\Tests;
use GuzzleHttp\Exception\ClientException;
use Naroat\VoiceApi\Contract\DriverInterface;
use Naroat\VoiceApi\Voice;
use Psr\Http\Message\ResponseInterface;

class VoiceTest extends \PHPUnit\Framework\TestCase
{
    public function testTTS()
    {
        $voice = new Voice();
        $aliyunVoice = $voice->driver('aliyun', [
            'appkey' => 'Nr656ZMxQxhbxl5h',
            'token' => '7de20354eb9f4bec8501d0cca53a20cd',
        ]);
        $this->assertInstanceOf(DriverInterface::class, $aliyunVoice);

        $response = $aliyunVoice->setText('你好啊，你好啊，你好啊，你好啊，你好啊，你好啊，你好啊，')
            ->setVoice('aijia')
            ->setFormat('mp3')
            ->tts();

        $this->assertInstanceOf(ResponseInterface::class, $response);

        //save file
        if ($response->getStatusCode() == 200 && in_array('audio/mpeg', $response->getHeader('Content-Type'))) {
            file_put_contents('./tmp.mp3', $response->getBody());
        }
    }
}