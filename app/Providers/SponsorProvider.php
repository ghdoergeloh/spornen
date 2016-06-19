<?php

namespace App\Providers;

use App\Domain\Model\Sponsor\SponsorService;
use Illuminate\Support\ServiceProvider;

class SponsorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('composer', function ($app) {
            return new SponsorService($app['files'], $app->basePath());
        });
    }
}
