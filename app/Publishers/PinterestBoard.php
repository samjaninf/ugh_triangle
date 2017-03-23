<?php
namespace App\Publishers;


use App\Contracts\PublisherInterface;
use DirkGroenen\Pinterest\Pinterest;

class PinterestBoard implements PublisherInterface
{
    private $pinterest;

    public function __construct()
    {
        $this->pinterest = new Pinterest(\Config::get('oauth-5-laravel.consumers.Pinterest.client_id'), \Config::get('oauth-5-laravel.consumers.Pinterest.client_secret'));
    }

    public function post($post)
    {
        $this->pinterest->auth->setOAuthToken($post->profile->access_token);
        if ($post->images != "") {
            foreach (json_decode($post->images) as $image) {
                $this->pinterest->pins->create(array(
                    "note" => $post->content,
                    "image_url" => $image,
                    "board" => $post->profile->e_id
                ));
            }
        } else {

            $this->pinterest->pins->create(array(
                "note" => $post->content,
                "link" => $post->link,
                "image_url" => "http://www.keenthemes.com/preview/metronic/theme/assets/global/plugins/jcrop/demos/demo_files/image2.jpg",
                "board" => $post->profile->e_id
            ));
        }
    }
}