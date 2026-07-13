<?php

namespace App\Providers;

use App\View\Composers\TaskFormOptionsComposer;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        View::composer(
            ['Task.index', 'Task.create', 'Task.edit'],
            TaskFormOptionsComposer::class,
        );

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
