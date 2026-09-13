<?php

namespace App\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use JsonException;

class LocaleManager
{
    /**
     * @return array<string, string>
     */
    public static function available(): array
    {
        return config('locales.available', []);
    }

    public static function isValid(string $locale): bool
    {
        return array_key_exists($locale, self::available());
    }

    public static function default(): string
    {
        foreach ([config('app.locale'), config('app.fallback_locale')] as $locale) {
            if (is_string($locale) && self::isValid($locale)) {
                return $locale;
            }
        }

        $locale = array_key_first(self::available());

        return is_string($locale) ? $locale : 'kk';
    }

    public static function apply(string $locale): void
    {
        app()->setLocale($locale);

        $carbonLocale = config("locales.carbon.{$locale}", $locale);
        Carbon::setLocale($carbonLocale);
    }

    /**
     * @return array<string, string>
     */
    public static function translations(string $locale): array
    {
        $path = lang_path("{$locale}.json");

        if (! file_exists($path)) {
            return [];
        }

        $version = filemtime($path) ?: 0;
        $cacheKey = "translations.{$locale}";
        $cached = Cache::get($cacheKey);

        if (
            is_array($cached)
            && ($cached['version'] ?? null) === $version
            && is_array($cached['translations'] ?? null)
        ) {
            return self::onlyStringTranslations($cached['translations']);
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            return [];
        }

        try {
            $decoded = json_decode(
                $contents,
                true,
                512,
                JSON_THROW_ON_ERROR,
            );
        } catch (JsonException $exception) {
            report($exception);
            Cache::forever($cacheKey, [
                'version' => $version,
                'translations' => [],
            ]);

            return [];
        }

        if (! is_array($decoded)) {
            return [];
        }

        $translations = self::onlyStringTranslations($decoded);

        Cache::forever($cacheKey, [
            'version' => $version,
            'translations' => $translations,
        ]);

        return $translations;
    }

    public static function clearCache(?string $locale = null): void
    {
        if ($locale !== null) {
            Cache::forget("translations.{$locale}");

            return;
        }

        foreach (array_keys(self::available()) as $code) {
            Cache::forget("translations.{$code}");
        }
    }

    /**
     * @param  array<mixed>  $translations
     * @return array<string, string>
     */
    private static function onlyStringTranslations(array $translations): array
    {
        $normalized = [];

        foreach ($translations as $key => $value) {
            if (is_string($key) && is_string($value)) {
                $normalized[$key] = $value;
            }
        }

        return $normalized;
    }
}
