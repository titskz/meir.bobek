<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Support\MediaStorage;
use Inertia\Inertia;
use Inertia\Response;

class TeamController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('site/Team', [
            'settings' => SiteSettingResource::make(SiteSetting::current())->resolve(),
            'members' => TeamMember::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (TeamMember $m) => [
                    ...$m->toArray(),
                    'image_url' => MediaStorage::url($m->image),
                ]),
        ]);
    }
}
