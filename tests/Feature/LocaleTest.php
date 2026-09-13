<?php

use Inertia\Testing\AssertableInertia as Assert;

test('locale can be switched via cookie', function () {
    $this->from('/login')
        ->get(route('locale.switch', 'kk'))
        ->assertRedirect('/login');

    $this->withUnencryptedCookie('locale', 'kk')
        ->get(route('login'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->where('locale', 'kk')
            ->has('translations')
        );
});

test('invalid locale returns not found', function () {
    $this->get(route('locale.switch', 'en'))->assertNotFound();
});

test('login page shares kazakh translations by default', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->where('locale', 'kk')
            ->where(
                'translations',
                fn ($translations) => ($translations['auth.login.submit'] ?? null) === 'Кіру',
            )
        );
});
