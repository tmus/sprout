<?php

namespace Tommus\Sprout;

use Illuminate\Support\ServiceProvider;

class SproutServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            [
                Commands\Run::class,
                Commands\Make::class,
            ]
        );

        $this->mergeConfigFrom(__DIR__.'/config/sprout.php', 'sprout');
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/config/sprout.php' => config_path('sprout.php'),
            ],
            'sprout'
        );
    }
}
