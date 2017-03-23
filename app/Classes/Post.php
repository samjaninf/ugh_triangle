<?php
namespace App\Classes;


use App\Events\NewPostHasBeenCreated;

class Post
{


    /*
     * Proceeds the post
     */
    public static function delete(\App\Post $post)
    {
        return $post->profile->getRepository();
    }

    public function save($post, $profile, $data)
    {
        $post->content = Spintax::transform($data['text']);

        $post->profile_id = $profile->id;
        if ($data['submit'] == "schedule") {
            $post->publish_type = 1;
            $post->time = strtotime($data['date']);
        }
        if ($data['type'] == 'link') {
            $bitly = $profile->bitly()->first();
            if ($bitly != null) {
                $short = $bitly->short($data['link']);
                $post->link = $short;
            } else {
                $post->link = $data['link'];
            }
        }
        if ($data['type'] == 'photo') {
            $post->images = $data['urls'];
            $new_array = [];
            foreach (json_decode($post->images) as $image) {
                $img = \Image::make($image);
                if ($profile->watermark != "") {
                    $width = $img->width() * $profile->width_perc;
                    $ratio = $profile->w_width / $profile->w_height;
                    $watermark = \Image::make($profile->watermark);
                    $watermark->resize($width, $width / $ratio);
                    $paddings = json_decode($profile->w_paddings, true);
                    $wRatio = $img->width() / 796;
                    $hRatio = $img->height() / 596;
                    $paddings['left'] *= $wRatio;
                    $paddings['top'] *= $hRatio;
                    $img->insert($watermark, "top-left", (int)$paddings['left'], (int)$paddings['top']);
                }
                $post->save();
                $filename = explode(".", $image);
                $filename = $filename[count($filename) - 1];
                $new_array[] = url("pics/" . $post->id . '_post.' . $filename);
                \File::delete('files/thumbnail/' . $filename);
                \File::delete('files/' . $filename);
                $img->save(public_path("pics/" . $post->id . '_post.' . $filename));
            }
            $post->images = json_encode($new_array);
        }
        if ($data['submit'] == "now") {
            $post->time = time();
        }

        if ($data['submit'] == "in_time") {
            $nextTime = getAvailablePredefinedTime($profile);
            $post->publish_type = 2;
            $post->time = $nextTime[1];
            $post->ptime = $nextTime[0]->id;
        }

        $post->save();
        \Event::fire(new NewPostHasBeenCreated($post, \Auth::user()));
        return $post;
    }

    public function reorder($type)
    {
        $post = \App\Post::findOrFail(\Request::input('id'));
        if ($type != "up") {
            $nextPost = \App\Post::where('ptime', '<>', 0)->where('published', 0)->where('time', '>', $post->time)->orderBy('time', 'ASC')->first();
            if ($nextPost != null) {
                $ptime = $post->ptime;
                $time = $post->time;
                $post->ptime = $nextPost->ptime;
                $post->time = $nextPost->time;
                $nextPost->ptime = $ptime;
                $nextPost->time = $time;
                $post->save();
                $nextPost->save();
            }
        } else {
            $prevPost = \App\Post::where('ptime', '<>', 0)->where('published', 0)->where('time', '<', $post->time)->orderBy('time', 'DESC')->first();
            if ($prevPost != null) {
                $ptime = $post->ptime;
                $time = $post->time;
                $post->ptime = $prevPost->ptime;
                $post->time = $prevPost->time;
                $prevPost->ptime = $ptime;
                $prevPost->time = $time;
                $post->save();
                $prevPost->save();
            }
        }
    }

    public function publish($request)
    {
        $profiles = Profile::where('user_id', \Auth::user()->id)->get();
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
        }
    }

}