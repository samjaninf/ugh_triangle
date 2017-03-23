<?php
namespace App\Repos;


use App\Contracts\PostRepositoryInterface;
use App\Post;
use App\Profile;

class PostRepository implements PostRepositoryInterface
{


    public function __construct()
    {
        $this->post = new \App\Classes\Post();
    }

    /**
     * @param $request
     */
    public function proceed($request)
    {
        $profiles = Profile::own()->where('is_active', 1)->get();
        if (count($profiles)) {
            $ids = [];
            foreach ($profiles as $profile) {
                $ids[] = $profile->id;
            }
            foreach ($profiles as $profile) {
                $post = $this->post->save(new Post(), $profile, $request->all());
                if ($post->publish_type == 0) {
                    $name = \Config::get('publishers.' . $post->profile->type);
                    $publisher = new $name();
                    $publisher->post($post);
                    $post->published = 1;
                }
                $post->save();
            }
            return ["s", tr("the_post_is_processed_successfully")];
        } else {
            return ["e", tr("you_must_select_a_profile")];
        }
    }
}