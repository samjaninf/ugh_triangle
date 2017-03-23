<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Profile;

class DashboardController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }


    public function doLogin()
    {
        $creds = [
            "email" => \Request::input('email'),
            "password" => \Request::input('password'),
            "is_admin" => 1
        ];
        if (\Auth::attempt($creds)) {
            \Session::put('logged_admin', 1);
            return \Redirect::intended('admin/dashboard');
        } else {
            return \Redirect::back()->with('error', 'Wrong username / password');
        }
    }

    public function logout()
    {
        \Session::forget('logged_admin');
        \Auth::logout();
        return \Redirect::to('admin/logout');
    }

    public function index()
    {
        $last_week_posts = [];
        for ($i = 6; $i >= 0; $i--) {
            $last_week_posts[$i]["date"] = date("Y-m-d", time() - 30000 - ($i * 86400));
            $last_week_posts[$i]["posts"] = Post::where('time', '<', time() - ($i * 86400))->where('time', '>', time() - 86400 - ($i * 86400))->count();
        }
        $profiles = [];
        $all = Profile::count();
        if ($all == 0) {
            $profiles["fb"] = 0;
            $profiles["twitter"] = 0;
            $profiles["linkedin"] = 0;
        } else {
            $profiles["fb"] = Profile::whereIn('type', ['fb_profile', 'fb_page', 'fb_group', 'fb_event'])->count() / $all * 100;
            $profiles["twitter"] = Profile::whereIn('type', ['twitter'])->count() / $all * 100;
            $profiles["linkedin"] = Profile::whereIn('type', ['linkedin', 'linkedin_page'])->count() / $all * 100;
        }

        return view('admin.index', compact('last_week_posts', 'profiles'));
    }

    public function translations()
    {
        return view('admin.translations');
    }
}
