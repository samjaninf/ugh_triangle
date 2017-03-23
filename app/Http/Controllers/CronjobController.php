<?php

namespace App\Http\Controllers;

use App\Post;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class CronjobController extends Controller
{
    public function doCron(LaravelFacebookSdk $fb)
    {
        $time = strtotime(date("Y-m-d H:i"));
        foreach (Post::where(function ($query) use ($time) {
            $query->where('published', 0)->where('time', $time);
        })->orWhere(function ($query) {
            $query->where('published', 0)->where('publish_type', 0);
        })->with('profile')->get() as $post) {
            $name = \Config::get('publishers.' . $post->profile->type);
            $publisher = new $name();
            $publisher->post($post);
            $post->published = 1;
            $post->save();
        }
    }
}
