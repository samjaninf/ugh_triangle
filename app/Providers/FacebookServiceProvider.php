<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('App\Contracts\FacebookRepositoryInterface', 'App\Repos\Api\FacebookRepository');
    }
}
