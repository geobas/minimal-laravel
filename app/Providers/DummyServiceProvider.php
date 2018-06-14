<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DummyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        echo '<h3>boot</h3>';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        echo '<h2>register</h2>';
    }
}
