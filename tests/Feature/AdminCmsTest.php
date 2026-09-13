<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin routes require authentication and admin privileges', function () {
    $this->get(route('admin.groups.index'))->assertRedirect(route('login'));

    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(route('admin.groups.index'))
        ->assertForbidden();

    $admin = User::factory()->admin()->create();
    $this->actingAs($admin)
        ->get(route('admin.groups.index'))
        ->assertOk();
});

test('an admin can create a group with a safely stored image', function () {
    Storage::fake('public');
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->post(route('admin.groups.store'), [
            'title' => 'Балапан тобы',
            'slug' => '',
            'content' => '<p>Топ туралы</p>',
            'image' => UploadedFile::fake()->image('group.jpg', 800, 600),
            'sort_order' => 3,
            'is_active' => '1',
        ])
        ->assertRedirect(route('admin.groups.index'));

    $group = Group::query()->sole();

    expect($group->slug)
        ->not->toBeEmpty()
        ->and($group->is_active)->toBeTrue()
        ->and($group->image)->toEndWith('.jpg');

    Storage::disk('public')->assertExists($group->image);
});

test('an admin can deactivate a group', function () {
    $admin = User::factory()->admin()->create();
    $group = Group::query()->create([
        'title' => 'Балапан',
        'slug' => 'balapan',
        'is_active' => true,
    ]);

    $this->actingAs($admin)
        ->put(route('admin.groups.update', $group), [
            'title' => $group->title,
            'slug' => $group->slug,
            'content' => '',
            'sort_order' => 0,
            'is_active' => '0',
        ])
        ->assertRedirect(route('admin.groups.index'));

    expect($group->fresh()?->is_active)->toBeFalse();
});
