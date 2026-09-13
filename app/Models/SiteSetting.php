<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'meta_keywords',
        'meta_description',
        'logo',
        'favicon',
        'phone',
        'email',
        'address',
        'instagram',
        'whatsapp',
        'facebook',
        'tiktok',
        'documents_iframe_url',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'manager_name',
        'manager_position',
        'manager_bio',
        'manager_photo',
        'advantages',
        'footer_text',
    ];

    protected function casts(): array
    {
        return [
            'advantages' => 'array',
        ];
    }

    public static function current(): self
    {
        $id = Cache::rememberForever('site_settings_id', function (): int {
            return (int) self::query()->firstOrCreate([])->getKey();
        });

        $settings = self::query()->find($id);

        if ($settings instanceof self) {
            return $settings;
        }

        self::flushCache();

        return self::query()->firstOrCreate([]);
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings');
        Cache::forget('site_settings_id');
    }

    protected static function booted(): void
    {
        static::saved(fn () => self::flushCache());
    }
}
