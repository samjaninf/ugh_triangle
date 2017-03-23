<?php
namespace App\Classes;


use App\Post;
use App\Profile;
use App\Repos\Api\FacebookRepository;

class Stats
{


    public static function getPageInsights(Profile $profile)
    {
        if ($profile->type == "fb_page") {

        } else {
            return false;
        }
    }

    public static function getView(Profile $profile)
    {
        if (!\Cache::has('stats.' . $profile->id)) {
            $stats["last_week_posts"] = self::getLastWeeksPost($profile);
            if ($profile->type == "fb_page") {
                $repo = new FacebookRepository();
                $stats["page_insights"] = $repo->getPageInsights($profile);
            }
            \Cache::put('stats.' . $profile->id, $stats, 60);
        } else {
            $stats = \Cache::get('stats.' . $profile->id);
        }
        return view('app.statistics.' . $profile->type, compact('stats'));
    }

    public static function getLastWeeksPost(Profile $profile)
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $today = strtotime(date("Y-m-d")) - ($i * 86400);
            $data[date("Y-m-d", $today)] = Post::where('profile_id', $profile->id)->where('time', '>', $today)->where('time', '<', $today + 86400)->count();
        }
        return $data;
    }

    public function getProfiles()
    {
        $profiles = Profile::where('user_id', \Auth::user()->id)->get();
        return $profiles;
    }

}