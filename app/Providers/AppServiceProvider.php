<?php

namespace App\Providers;

use App\Models\User;
use App\Support\LocaleManager;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureLocale();
        $this->configureAuthorization();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    /**
     * Apply the default locale on boot for CLI and non-HTTP contexts.
     */
    protected function configureLocale(): void
    {
        $locale = config('app.locale');

        if (LocaleManager::isValid($locale)) {
            LocaleManager::apply($locale);
        }
    }

    protected function configureAuthorization(): void
    {
        Gate::define('access-admin', fn (User $user): bool => $user->is_admin);
    }
}
