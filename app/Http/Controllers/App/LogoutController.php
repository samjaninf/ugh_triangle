<?php
namespace App\Http\Controllers\App;


use App\Http\Controllers\Controller;

class LogoutController extends Controller
{

    public function logout()
    {
        \Auth::logout();
        return \Redirect::to('/');
    }
}