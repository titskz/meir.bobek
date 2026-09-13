<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Support\MediaStorage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('admin/Settings/Edit', [
            'settings' => SiteSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = SiteSetting::current();

        $data = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'favicon' => ['nullable', 'file', 'mimes:png,ico', 'max:2048'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'documents_iframe_url' => ['nullable', 'url', 'max:2000'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:1000'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'manager_name' => ['nullable', 'string', 'max:255'],
            'manager_position' => ['nullable', 'string', 'max:255'],
            'manager_bio' => ['nullable', 'string'],
            'manager_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'advantages' => ['nullable', 'array'],
            'advantages.*.title' => ['required_with:advantages', 'string', 'max:255'],
            'advantages.*.description' => ['nullable', 'string', 'max:500'],
            'footer_text' => ['nullable', 'string', 'max:1000'],
        ]);

        foreach (['logo', 'favicon', 'hero_image', 'manager_photo'] as $field) {
            if ($request->hasFile($field)) {
                MediaStorage::delete($settings->{$field});
                $data[$field] = MediaStorage::store($request->file($field), 'settings');
            } else {
                unset($data[$field]);
            }
        }

        $settings->update($data);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('flash.saved')]);

        return to_route('admin.settings.edit');
    }
}
