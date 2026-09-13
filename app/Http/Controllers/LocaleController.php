<?php

namespace App\Http\Controllers;

use App\Support\LocaleManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch the application locale.
     */
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        if (! LocaleManager::isValid($locale)) {
            abort(404);
        }

        return back()->cookie('locale', $locale, 60 * 24 * 365);
    }
}
