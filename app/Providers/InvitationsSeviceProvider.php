<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InvitationsSeviceProvider extends ServiceProvider
{
    /**
     * Register the InvitationRepository
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\InvitationRepositoryInterface', 'App\Repos\InvitationRepository');
    }
}
