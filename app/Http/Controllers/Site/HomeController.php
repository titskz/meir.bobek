<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\GalleryItem;
use App\Models\Group;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Support\MediaStorage;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $settings = SiteSettingResource::make(
            SiteSetting::current(),
        )->resolve();

        return Inertia::render('site/Home', [
            'settings' => $settings,
            'aboutPage' => Page::query()
                ->where('slug', 'about')
                ->where('is_published', true)
                ->first(),
            'team' => TeamMember::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (TeamMember $m) => [
                    ...$m->toArray(),
                    'image_url' => MediaStorage::url($m->image),
                ]),
            'groups' => Group::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Group $g) => [
                    ...$g->toArray(),
                    'image_url' => MediaStorage::url($g->image),
                ]),
            'gallery' => GalleryItem::query()
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
