<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestPublishers extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPublishing()
    {
        $sdk = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $profile = \App\Profile::first();
        $sdk->setDefaultAccessToken($profile->access_token);
        $res = $sdk->post('/me/feed', array(
            'message' => "Testing SocialOcean (Triangle)",
            'link' => "http://triangle.ioanmarinov.com"
        ));
        $id = json_decode($res->getBody(), true)["id"];
        dd($id);
    }


}
