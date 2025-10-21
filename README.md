# Laravel AI Helper

Laravel projelerine OpenAI, Anthropic gibi AI sağlayıcılarını kolayca entegre etmenizi sağlayan yardımcı paket.

## Özellikler

- `Ai::complete("...")`, `Ai::chat("...")`, `Ai::generateFile("pdf", $content)` gibi facade yapısı
- Config üzerinden model, anahtar, hız ayarları
- Cache + queue desteği
- Prompt loglama

## Kurulum

```bash
composer require tncy/laravel-aihelper
```

## Kullanım

```php
use Tncy\AiHelper\Facades\Ai;

$text = Ai::complete('Laravel nedir?');
$image = Ai::image('bir avukat logosu oluştur');
```

## Yapılandırma

config/ai.php dosyasını oluşturmak için:

```bash
php artisan vendor:publish --provider="Tncy\AiHelper\AiHelperServiceProvider"
```

## Lisans

MIT License