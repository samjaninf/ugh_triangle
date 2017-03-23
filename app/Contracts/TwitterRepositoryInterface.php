<?php
namespace App\Contracts;


use App\Profile;

interface TwitterRepositoryInterface
{
    public function delete($post);

    public function getFeeds(Profile $profile);

    public function login($request);
}