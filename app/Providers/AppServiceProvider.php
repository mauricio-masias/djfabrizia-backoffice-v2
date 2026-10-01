<?php

namespace App\Providers;

use App\Observers\PublishesToEndpoint;
use App\Publishing\ContentTopics;
use Djfabrizia\Content\ContentServiceProvider;
use Djfabrizia\Content\Exceptions\ReferencedContentException;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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

        // One password rule for the profile page and the Users form.
        Password::defaults(fn (): Password => Password::min(12));

        foreach (ContentTopics::OBSERVED as $model) {
            $model::observe(PublishesToEndpoint::class);
        }

        // Content used by a page block cannot be deleted (the models refuse);
        // tell the editor why instead of showing an error page.
        DeleteAction::configureUsing(fn (DeleteAction $action) => $action->using(
            function (Model $record, DeleteAction $action): bool {
                try {
                    return (bool) $record->delete();
                    // Thrown by the model's `deleting` listener, which static analysis cannot see.
                    // @phpstan-ignore catch.neverThrown
                } catch (ReferencedContentException $exception) {
                    Notification::make()->title('Cannot delete')->body($exception->getMessage())->danger()->persistent()->send();
                    $action->halt();
                }
            },
        ));
    }
}
