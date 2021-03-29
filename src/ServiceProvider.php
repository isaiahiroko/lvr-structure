<?php

namespace Isaiahiroko\Structure;

use Illuminate\Support\ServiceProvider as AppServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Isaiahiroko\Structure\Commands\Install;

class ServiceProvider extends AppServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // TODO: fix error Class Illuminate\Database\Eloquent\Factory does not exist
        // if (!app()->environment('production') && $this->app->runningInConsole()) {
        //     $this->app->make(Factory::class)->load(__DIR__.'/factories');
        // }

        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'structure'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/isaiahiroko/structure'),
            __DIR__.'/config.php' => config_path('structure.php'),
            __DIR__.'/assets' => public_path('vendor/structure'),
        ], 'lvr-structure');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->loadViewsFrom(__DIR__.'/views', 'structure');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/migrations');
            $this->commands([
                Install::class,
            ]);
        }
    }
}
