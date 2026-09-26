<?php

namespace Djfabrizia\Content;

use Illuminate\Support\ServiceProvider;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register the shared content configuration.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/content.php', 'content');
    }

    /**
     * Absolute path of the content schema migrations.
     *
     * Only the back office loads these (it owns the schema). The endpoint loads
     * them in its test suite to build the same schema on SQLite.
     */
    public static function migrationsPath(): string
    {
        return dirname(__DIR__).'/database/migrations';
    }
}
