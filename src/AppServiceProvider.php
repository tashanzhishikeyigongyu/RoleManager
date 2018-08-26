<?php

namespace LaravelEnso\RoleManager;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\RoleManager\app\Commands\Sync;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            Sync::class,
        ]);

        $this->loadDependencies();
        $this->publishesAll();
    }

    private function loadDependencies()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    private function publishesAll()
    {
        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'roles-assets');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'enso-assets');

        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds'),
        ], 'roles-seeder');

        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds'),
        ], 'enso-seeders');
    }

    public function register()
    {
        //
    }
}
