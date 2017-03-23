<?php
namespace App\Publishers;


use App\Contracts\PublisherInterface;

class FbProfile implements PublisherInterface
{
    public function __construct()
    {
        $this->fb = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
    }

    public function post($post)
    {
        $this->fb->setDefaultAccessToken($post->profile->access_token);
        if ($post->images != "") {
            foreach (json_decode($post->images) as $image) {
                $res = $this->fb->post('/me/photos', array(
                    'caption' => $post->content,
                    'url' => $image
                ));

            }
        } else {
            $res = $this->fb->post('/me/feed', array(
                'message' => $post->content,
                'link' => $post->link
            ));
            $id = json_decode($res->getBody(), true)["id"];
            $post->post_id = $id;
        }
        $post->has_likes = 1;
        $post->has_comments = 1;
        $post->save();
    }

    public function comment($post, $comment)
    {

    }
}