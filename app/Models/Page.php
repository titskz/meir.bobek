<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'meta_title',
        'meta_description',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Page $page): void {
            if (blank($page->slug) && filled($page->title)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }
}
