<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PublicationRating;
use Illuminate\Support\Facades\URL;
use App\Observers\PublicationRatingObserver;

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
        PublicationRating::observe(PublicationRatingObserver::class);
        URL::forceScheme('https');
    }
}
