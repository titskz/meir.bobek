<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\GalleryItem;
use App\Models\SiteSetting;
use App\Support\MediaStorage;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('site/Gallery', [
            'settings' => SiteSettingResource::make(SiteSetting::current())->resolve(),
            'items' => GalleryItem::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (GalleryItem $item) => [
                    ...$item->toArray(),
                    'image_url' => MediaStorage::url($item->image),
                ]),
        ]);
    }
}
