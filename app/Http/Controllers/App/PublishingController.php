<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Post;

class PublishingController extends Controller
{
    public function index()
    {
        return view('app.posts');

    }


    public function getPart()
    {
        if (\Request::input('date_from') != "" || \Request::input('date_to') != "" || \Request::input('profile') != 0) {
            if (\Request::input('profile') != 0) {
                $posts = Post::own()->where('time', '>', \Request::input('date_from') != "" ? strtotime(\Request::get('date_from')) : 0)->where('time', '<', \Request::input('date_to') != "" ? strtotime(\Request::get('date_to')) : 9999999999)->where('profile_id', \Request::input('profile'))->orderBy('time', 'DESC')->paginate(10);
            } else {
                $posts = Post::own()->where('time', '>', strtotime(\Request::get('date_from')))->where('time', '<', strtotime(\Request::get('date_to')))->orderBy('time', 'DESC')->paginate(10);
            }
        } else {
            $posts = Post::own()->orderBy('time', 'DESC')->paginate(10);
        }
        return view('app.parts.posts', compact('posts'));
    }
}
