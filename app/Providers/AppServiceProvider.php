<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FirebaseModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FirebaseModel::class, function () {
            return new FirebaseModel();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
