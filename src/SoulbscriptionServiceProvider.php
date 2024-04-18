<?php

namespace LucasDotVin\Soulbscription;

use Illuminate\Support\ServiceProvider;

class SoulbscriptionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/soulbscription.php', 'soulbscription');

        if (! config('soulbscription.database.cancel_migrations_autoloading')) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        $this->publishes([
            __DIR__ . '/../config/soulbscription.php' => config_path('soulbscription.php'),
        ], 'soulbscription-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'soulbscription-migrations');

        $this->publishes([
            __DIR__ . '/../database/seeder' => database_path('seeder'),
        ], 'soulbscription-migrations');

    }
}
