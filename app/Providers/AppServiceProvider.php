<?php

namespace App\Providers;

use App\Models\Field;
use App\Models\Identity;
use App\Models\Statistics;
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

            if (Schema::hasTable('statistics')) {
                $todayVisitors = Statistics::whereDate('created_at', today())->count();
                $totalVisitors = Statistics::count();

                $view->with('today_visitors', $todayVisitors);
                $view->with('total_visitors', $totalVisitors);
            }
        });
    }
}
