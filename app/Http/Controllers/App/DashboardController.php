<?php

namespace App\Http\Controllers\App;

use App\Classes\Stats;
use App\Http\Controllers\Controller;
use App\Post;
use Excel;

class DashboardController extends Controller
{

    private $stats;

    public function __construct()
    {
        $this->stats = new Stats();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = \Auth::user()->getProfiles();
        return view('app.dashboard', compact('profiles'));
    }

    public function newDashboard()
    {
        $profiles = \Auth::user()->getProfiles();
        return view('app.new_dashboard', compact('profiles'));
    }

    public function showFooter()
    {
        $profiles = \Auth::user()->getProfiles();
        $posts = Post::whereIn('profile_id', $profiles->lists('id'))->with(['profile'])->orderBy('time', 'DESC')->get();
        $past_posts = Post::whereIn('profile_id', $profiles->lists('id'))->with(['profile'])->where('published', 1)->orderBy('updated_at', 'DESC')->limit(5)->get();
        $future_posts = Post::whereIn('profile_id', $profiles->lists('id'))->with(['profile'])->where('published', 0)->orderBy('time', 'ASC')->get();
        return view('app.parts.dashboard_footer', compact('future_posts', 'past_posts', 'posts'));
    }
}