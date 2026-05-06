<?php

namespace App\Providers;

use App\Models\Field;
use App\Models\Identity;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            if (Schema::hasTable('identity')) {
                // Satu query, semua key tersedia
                $view->with('site_identity', Identity::pluck('value', 'key'));
            }

            if (Schema::hasTable('fields')) {
                $view->with('fields', Field::whereNotIn('id', [1])->get());
            }
        });
    }
}
