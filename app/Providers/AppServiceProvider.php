<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\{App, RateLimiter};
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\{ServiceProvider, Str};


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
        App::setLocale('ar');

        RateLimiter::for('login', function (Request $request) {
            $identity = Str::lower((string) $request->input('identity'));

            return Limit::perMinute(5)->by(Str::transliterate($identity.'|'.$request->ip()));
        });
        PaginationPaginator::useBootstrap();
    }

}