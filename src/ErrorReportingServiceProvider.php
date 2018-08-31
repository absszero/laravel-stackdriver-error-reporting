<?php

namespace Absszero;

use Illuminate\Support\ServiceProvider;

class ErrorReportingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/error_reporting.php' => config_path('error_reporting.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
