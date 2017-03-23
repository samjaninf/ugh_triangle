<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\FacebookRepositoryInterface;
use App\Contracts\TwitterRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialLoginController extends Controller
{
    private $fbSdk;

    public function __construct()
    {
        $this->fbSdk = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
    }

    public function loginFb()
    {
        $login = $this->fbSdk->getLoginUrl(['email', 'public_profile']);
        return \Redirect::to($login);
    }

    public function loginTwitter(Request $request, TwitterRepositoryInterface $repo)
    {
        $res = $repo->login($request);
        return $res;
    }

    public function doLoginFb(Request $request, FacebookRepositoryInterface $repo)
    {
        $res = $repo->login($request);
        return $res;
    }
}
