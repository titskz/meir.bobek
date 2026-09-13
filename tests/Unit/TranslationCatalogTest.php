<?php

test('russian and kazakh translation catalogs contain identical keys', function () {
    $root = dirname(__DIR__, 2);
    $russian = json_decode(
        file_get_contents($root.'/lang/ru.json'),
        true,
        512,
        JSON_THROW_ON_ERROR,
    );
    $kazakh = json_decode(
        file_get_contents($root.'/lang/kk.json'),
        true,
        512,
        JSON_THROW_ON_ERROR,
    );

    expect($russian)->toBeArray()
        ->and($kazakh)->toBeArray()
        ->and(array_keys($russian))->toEqualCanonicalizing(array_keys($kazakh));
});

test('translation catalogs do not contain empty values', function () {
    $root = dirname(__DIR__, 2);

    foreach (['ru', 'kk'] as $locale) {
        $translations = json_decode(
            file_get_contents("{$root}/lang/{$locale}.json"),
            true,
            512,
            JSON_THROW_ON_ERROR,
        );

        expect(array_filter($translations, fn ($value) => $value === ''))
            ->toBeEmpty();
    }
});
