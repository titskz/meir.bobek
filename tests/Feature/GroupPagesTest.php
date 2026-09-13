<?php

use App\Models\Group;
use Inertia\Testing\AssertableInertia as Assert;

test('groups index contains every active group and excludes inactive groups', function () {
    Group::query()->create([
        'title' => 'Балапан',
        'slug' => 'balapan',
        'content' => '<p>Бірінші топ</p>',
        'sort_order' => 2,
        'is_active' => true,
    ]);
    Group::query()->create([
        'title' => 'Қарлығаш',
        'slug' => 'karlygash',
        'sort_order' => 1,
        'is_active' => true,
    ]);
    Group::query()->create([
        'title' => 'Жасырын топ',
        'slug' => 'hidden',
        'is_active' => false,
    ]);

    $this->get(route('site.groups'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('site/Groups')
            ->has('groups', 2)
            ->where('groups.0.slug', 'karlygash')
            ->where('groups.1.slug', 'balapan')
        );
});

test('an active group has a public detail page', function () {
    $group = Group::query()->create([
        'title' => 'Балапан',
        'slug' => 'balapan',
        'content' => '<p>Топ туралы</p>',
        'is_active' => true,
    ]);

    $this->get(route('site.groups.show', ['group' => $group->slug]))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('site/GroupShow')
            ->where('group.id', $group->id)
            ->where('group.slug', 'balapan')
        );
});

test('an inactive group detail page is not public', function () {
    $group = Group::query()->create([
        'title' => 'Жасырын топ',
        'slug' => 'hidden',
        'is_active' => false,
    ]);

    $this->get(route('site.groups.show', ['group' => $group->slug]))->assertNotFound();
});
