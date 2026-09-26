<?php

namespace App\Providers;

use Djfabrizia\Content\ContentServiceProvider;
use Illuminate\Database\Eloquent\Model;
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
        // The back office owns the content schema, so only this app runs the
        // shared package's migrations. The endpoint only reads the tables.
        $this->loadMigrationsFrom(ContentServiceProvider::migrationsPath());

        Model::shouldBeStrict(! $this->app->isProduction());
    }
}
