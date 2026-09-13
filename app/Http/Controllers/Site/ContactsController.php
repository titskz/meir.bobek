<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class ContactsController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('site/Contacts', [
            'settings' => SiteSettingResource::make(SiteSetting::current())->resolve(),
        ]);
    }
}
