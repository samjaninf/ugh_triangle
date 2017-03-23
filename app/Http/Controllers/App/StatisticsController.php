<?php

namespace App\Http\Controllers\App;

use App\Classes\Stats;
use App\Http\Controllers\Controller;
use App\Profile;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class StatisticsController extends Controller
{
    public function index(LaravelFacebookSdk $sdk)
    {
        $profiles = \Auth::user()->getProfiles();
        $post_stats = "";
        if (\Request::has('profile')) {
            $profile = Profile::find(\Request::get('profile'));
            $post_stats = Stats::getLastWeeksPost($profile);
        }
        return view('app.statistics.index', compact('profiles', 'post_stats'));
    }

    public function show()
    {
        $profile = Profile::findOrFail(\Request::input('profile'));
        $view = Stats::getView($profile);
        return $view;
    }
}
