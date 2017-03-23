<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestComments extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_post_comments()
    {
        $sdk = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $profile = \App\Profile::first();
        $sdk->setDefaultAccessToken($profile->access_token);
        $res = $sdk->get("/582324855248300_599669006847218/comments");
        dd($res->getBody());
    }
}
