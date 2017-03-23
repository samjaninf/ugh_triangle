<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Contracts\TwitterRepositoryInterface', 'App\Repos\Api\TwitterRepository');
    }
}
