<?php

namespace App\Http\Resources;

use App\Models\SiteSetting;
use App\Support\MediaStorage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SiteSetting */
class SiteSettingResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site_name' => $this->site_name,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'logo' => MediaStorage::url($this->logo),
            'favicon' => MediaStorage::url($this->favicon),
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'instagram' => $this->instagram,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'tiktok' => $this->tiktok,
            'documents_iframe_url' => $this->documents_iframe_url,
            'hero_title' => $this->hero_title,
            'hero_subtitle' => $this->hero_subtitle,
            'hero_image' => MediaStorage::url($this->hero_image),
            'manager_name' => $this->manager_name,
            'manager_position' => $this->manager_position,
            'manager_bio' => $this->manager_bio,
            'manager_photo' => MediaStorage::url($this->manager_photo),
            'advantages' => $this->advantages ?? [],
            'footer_text' => $this->footer_text,
        ];
    }
}
