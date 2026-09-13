<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class DocumentsController extends Controller
{
    public function __invoke(): Response
    {
        $settings = SiteSetting::current();

        return Inertia::render('site/Documents', [
            'settings' => SiteSettingResource::make($settings)->resolve(),
            'iframeUrl' => $settings->documents_iframe_url,
        ]);
    }
}
