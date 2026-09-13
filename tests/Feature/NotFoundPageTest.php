<?php

use Inertia\Testing\AssertableInertia as Assert;

test('unknown web routes render the branded not found page', function () {
    $this->get('/missing-page')
        ->assertNotFound()
        ->assertInertia(fn (Assert $page) => $page
            ->component('site/NotFound')
            ->has('settings')
            ->where('locale', 'kk')
        );
});

test('unknown json routes keep a json error response', function () {
    $this->getJson('/api/missing-page')
        ->assertNotFound()
        ->assertJsonStructure(['message']);
});
