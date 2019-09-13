<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ClientRepository;
use App\Client;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindClientRepository();
    }

    /**
     * Bind implementation to interface.
     *
     * @return object \App\Repositories\ClientRepository
     */
    private function bindClientRepository()
    {
        $this->app->bind('App\Contracts\ClientRepositoryInterface', function() {
            return new ClientRepository(new Client());
        });
    }
}
