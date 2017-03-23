<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Post;
use App\Repos\Api\FacebookRepository;

class CommentsController extends Controller
{
    /**
     * Creating an comment
     */
    public function create()
    {
        $repo = new FacebookRepository();
        $post_id = \Request::input('post_id');
        $post = Post::where('post_id', $post_id)->first();
        $repo->comment($post, \Request::input('comment'));
        \Cache::forget('postComments.' . $post->id);
    }

    /*
     * Loading all comments
     */
    public function load()
    {
        $post = Post::findOrFail(\Request::input('id'));
        $comments = $post->getApiData("comments", []);
        return view('app.parts.comments', compact('comments', 'post'));
    }
}
