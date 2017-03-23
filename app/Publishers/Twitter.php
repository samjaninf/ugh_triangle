<?php
namespace App\Publishers;


class Twitter
{


    public function post($post)
    {
        \Session::put('access_token', ["oauth_token" => json_decode($post->profile->access_token)[0], "oauth_token_secret" => json_decode($post->profile->access_token)[1]]);
        if ($post->images != "") {
            foreach (json_decode($post->images) as $image) {
                $image = str_replace(url('/') . '/', "", $image);
                $id = \Twitter::uploadMedia(['media' => \File::get(public_path($image))]);
                \Twitter::postTweet(["status" => $post->content, "media_ids" => $id->media_id_string]);
            }
        } else {
            $content = $post->content;
            if ($post->link) {
                $content = $post->link . " " . $post->content;
            }
            \Twitter::postTweet(["status" => $content]);
        }
    }

}