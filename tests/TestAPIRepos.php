<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestAPIRepos extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_repos()
    {
        $post = \App\Post::first();
        dd($post->profile->getRepository());
    }
}
