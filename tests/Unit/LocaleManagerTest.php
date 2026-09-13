<?php

use App\Support\LocaleManager;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

uses(TestCase::class);

test('invalid translation json fails gracefully', function () {
    $originalLangPath = lang_path();
    $temporaryLangPath = sys_get_temp_dir().'/meir-i18n-'.bin2hex(random_bytes(6));
    mkdir($temporaryLangPath);
    file_put_contents($temporaryLangPath.'/broken.json', '{"invalid":');

    app()->useLangPath($temporaryLangPath);
    Cache::forget('translations.broken');

    try {
        expect(LocaleManager::translations('broken'))->toBe([]);
    } finally {
        Cache::forget('translations.broken');
        app()->useLangPath($originalLangPath);
        unlink($temporaryLangPath.'/broken.json');
        rmdir($temporaryLangPath);
    }
});

test('configured fallback locale is used when the primary locale is invalid', function () {
    config([
        'app.locale' => ['invalid'],
        'app.fallback_locale' => 'kk',
        'locales.available' => [
            'ru' => 'Русский',
            'kk' => 'Қазақша',
        ],
    ]);

    expect(LocaleManager::default())->toBe('kk');
});
