<?php
namespace Naroat\VoiceApi\Driver;

use Naroat\VoiceApi\Base;
use Naroat\VoiceApi\Exception\ErrorException;
use Naroat\VoiceApi\Contract\DriverInterface;
use Psr\Http\Message\ResponseInterface;

class Aliyun extends Base implements DriverInterface
{
    /**
     * api domain
     */
    const API_DOMAIN = 'https://nls-gateway-cn-shanghai.aliyuncs.com';

    /**
     * tts uri
     */
    const TTS_URI = '/stream/v1/tts';

    /**
     * app key
     *
     * @var string
     */
    public string $appkey;

    /**
     * token
     *
     * @var string
     */
    public string $token;

    /**
     * 待合成文本，文本内容必须采用UTF-8编码，长度不超过300个字符（英文字母之间需要添加空格）。
     *
     * @var string
     */
    public string $text;

    /**
     * 发音人
     *
     * @var string
     */
    public string $voice = 'xiaoyun';

    /**
     * 音频编码格式，支持.pcm、.wav和.mp3格式。默认值：pcm。
     *
     * @var string
     */
    public string $format = 'mp3';

    public function __construct(array $config)
    {
        parent::__construct();
        $this->appkey = $config['appkey'];
        $this->token = $config['token'];
    }

    public function tts(): ResponseInterface
    {
        $url = self::API_DOMAIN . self::TTS_URI;
        return $this->httpClient->post($url, [
            'headers' => $this->header(),
            'body' => json_encode([
                "appkey" => $this->appkey,
                "token" => $this->token,
                "text" => $this->text,
                "voice" => $this->voice,
                "format" => $this->format
            ])
        ]);
    }

    /**
     * set text
     *
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * set voice
     *
     * @param string $voice
     * @return $this
     */
    public function setVoice(string $voice): self
    {
        $this->voice = $voice;
        return $this;
    }

    /**
     * set format
     *
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;
        return $this;
    }
}