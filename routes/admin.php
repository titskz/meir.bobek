<?php

use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('pages', PageController::class)->except(['show']);
    Route::resource('groups', GroupController::class)->except(['show']);
    Route::resource('gallery', GalleryController::class)->except(['show'])->parameters(['gallery' => 'gallery']);
    Route::resource('team', TeamMemberController::class)->except(['show'])->parameters(['team' => 'team']);
    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');
});
