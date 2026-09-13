<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Site\ContactsController;
use App\Http\Controllers\Site\DocumentsController;
use App\Http\Controllers\Site\GalleryController;
use App\Http\Controllers\Site\GroupsController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{locale}', LocaleController::class)->name('locale.switch');

Route::get('/', HomeController::class)->name('site.home');
Route::get('/about', [PageController::class, 'about'])->name('site.about');
Route::get('/team', TeamController::class)->name('site.team');
Route::get('/documents', DocumentsController::class)->name('site.documents');
Route::get('/groups', [GroupsController::class, 'index'])->name('site.groups');
Route::get('/groups/{group:slug}', [GroupsController::class, 'show'])->name('site.groups.show');
Route::get('/gallery', GalleryController::class)->name('site.gallery');
Route::get('/contacts', ContactsController::class)->name('site.contacts');
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('site.pages.show');

Route::middleware(['auth'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/admin.php';
require __DIR__.'/settings.php';
