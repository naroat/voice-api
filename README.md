## 介绍

ai语音api

## 功能

已支持：
- 阿里云

## 使用

```php
$voice = new Voice();
$aliyunVoice = $voice->driver('aliyun', [
    'appkey' => 'you appkey',
    'token' => 'you token',
]);

$response = $aliyunVoice->setText('今天是周一，天气挺好的。')
    ->setVoice('xiaoyun')
    ->setFormat('mp3')
    ->tts();

//save file
if ($response->getStatusCode() == 200 && in_array('audio/mpeg', $response->getHeader('Content-Type'))) {
    file_put_contents('./tmp.mp3', $response->getBody());
}
```