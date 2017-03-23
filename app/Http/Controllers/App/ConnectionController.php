<?php

namespace App\Http\Controllers\App;

use App\Classes\Connector;
use App\Http\Controllers\Controller;
use App\Profile;
use Happyr\LinkedIn\LinkedIn;
use Illuminate\Http\Request;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class ConnectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('limitChecker');
    }

    public function fb_profile(LaravelFacebookSdk $fb)
    {
        $login = $fb->getLoginUrl(['email', 'public_profile', 'read_insights', 'manage_pages', 'user_events', 'publish_actions', 'user_managed_groups', 'publish_pages', 'user_posts']);
        return \Redirect::to($login);
    }

    public function fb_event(LaravelFacebookSdk $fb)
    {
        $profiles = Profile::where('type', 'fb_profile')->where('user_id', \Auth::user()->id)->get();
        if (!count($profiles)) {
            return \Redirect::back()->with('error', 'Първо трябва да свържеш FB Профил');
        } else {
            return view('app.fb.events', compact('profiles', 'fb'));
        }
    }

    public function linkedin_page()
    {
        $profiles = Profile::where('type', 'linkedin_profile')->where('user_id', \Auth::user()->id)->get();
        if (!count($profiles)) {
            return trans('messages.first_connect_linkedin_profile');
        } else {
            $linkedin = new LinkedIn(\Config::get('oauth-5-laravel.Linkedin.client_id'), \Config::get('oauth-5-laravel.Linkedin.client_secret'));
            $pages = [];
            foreach ($profiles as $profile) {
                $linkedin->setAccessToken($profile->access_token);
                $r = $linkedin->get("v1/companies?format=json&is-company-admin=true");
                if (isset($r['values'])) {
                    foreach ($r['values'] as $page) {
                        $page["p_id"] = $profile->id;
                        $pages[] = $page;
                    }
                }
            }
            return view('app.linkedin.pages', compact('profiles', 'linkedin', 'pages'));
        }
    }

    public function twitter()
    {
        // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;
        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        \Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = \Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {
            $url = \Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            \Session::put('oauth_state', 'start');
            \Session::put('oauth_request_token', $token['oauth_token']);
            \Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return \Redirect::to($url);
        }

        return \Redirect::route('twitter.error');
    }


    public function connectLinkedinPage()
    {
        $connector = new Connector("linkedin_page");
        return $connector->connect();
    }

    public function connectTwitter()
    {
        $connector = new Connector("twitter");
        return $connector->connect();
    }

    public function linkedin(Request $request)
    {
        $c = new Connector("linkedin");
        return $c->connect();
    }

    public function fb_group(LaravelFacebookSdk $fb)
    {
        $profiles = Profile::where('type', 'fb_profile')->where('user_id', \Auth::user()->id)->get();
        if (!count($profiles)) {
            return trans('messages.first_connect_fb_profile');
        } else {
            return view('app.fb.groups', compact('profiles', 'fb'));
        }
    }

    public function fb_page(LaravelFacebookSdk $fb)
    {
        $profiles = Profile::where('type', 'fb_profile')->where('user_id', \Auth::user()->id)->get();
        if (!count($profiles)) {
            return trans('messages.first_connect_fb_profile');
        } else {
            $pages = [];
            foreach ($profiles as $p) {
                $fb->setDefaultAccessToken($p->access_token);
                $res = $fb->get('/me/accounts');
                $pages[] = json_decode($res->getBody(), true);
            }
            return view('app.fb.pages', compact('pages'));
        }
    }

    public function connectFbPage()
    {
        $connector = new Connector("fb_page", ['page' => \Request::input('info')]);
        return $connector->connect();
    }


    public function connectFbEvent()
    {
        $connector = new Connector("fb_event", ['event' => \Request::input('info')]);
        return $connector->connect();
    }

    public function connectFbGroup()
    {
        $connector = new Connector("fb_group", ['group' => \Request::input('info')]);
        return $connector->connect();
    }

    public function connectPinterest(Request $request)
    {
        $connector = new Connector("pinterest");
        return $connector->connect();

    }
}
