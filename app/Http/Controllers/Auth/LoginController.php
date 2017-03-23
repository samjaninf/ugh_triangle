<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{


    public function login()
    {
        $creds = User::getLoginCreds();
        if (\Auth::attempt($creds, \Request::has('remember_me'))) {
            return \Redirect::intended('app/dashboard');
        } else {
            return \Redirect::back()->with('error', tr('wrong_credentials'));
        }
    }


}
