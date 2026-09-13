<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\Group;
use App\Models\SiteSetting;
use App\Support\MediaStorage;
use Inertia\Inertia;
use Inertia\Response;

class GroupsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('site/Groups', [
            'settings' => SiteSettingResource::make(SiteSetting::current())->resolve(),
            'groups' => Group::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Group $g) => [
                    ...$g->toArray(),
                    'image_url' => MediaStorage::url($g->image),
                ]),
        ]);
    }

    public function show(Group $group): Response
    {
        abort_unless($group->is_active, 404);

        return Inertia::render('site/GroupShow', [
            'settings' => SiteSettingResource::make(SiteSetting::current())->resolve(),
            'group' => [
                ...$group->toArray(),
                'image_url' => MediaStorage::url($group->image),
            ],
        ]);
    }
}
