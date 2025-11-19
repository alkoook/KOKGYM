<?php

namespace App\Providers;

use Filament\Facades\Filament;
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
   public function boot()
{
    Filament::serving(function () {
        config(['filament.tables.persist_filters' => false]);
        config(['filament.tables.persist_column_toggle_state' => false]);
        config(['filament.tables.persist_sort' => false]);
        config(['filament.forms.persist_state' => false]);

        // أهم وحدة!
        config(['filament.navigation.persist_navigation' => false]);
    });
}
}
