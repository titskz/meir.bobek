<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Support\MediaStorage;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function about(): Response
    {
        $page = Page::query()
            ->where('slug', 'about')
            ->where('is_published', true)
            ->firstOrFail();

        return $this->renderPage($page, 'site/About', [
            'team' => TeamMember::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(fn (TeamMember $member) => [
                    ...$member->toArray(),
                    'image_url' => MediaStorage::url($member->image),
                ]),
        ]);
    }

    public function show(Page $page): Response
    {
        abort_unless($page->is_published, 404);

        return $this->renderPage($page, 'site/Page');
    }

    /**
     * @param  array<string, mixed>  $extra
     */
    private function renderPage(Page $page, string $component, array $extra = []): Response
    {
        return Inertia::render($component, [
            'settings' => SiteSettingResource::make(SiteSetting::current())->resolve(),
            'page' => [
                ...$page->toArray(),
                'image_url' => MediaStorage::url($page->image),
            ],
            ...$extra,
        ]);
    }
}
