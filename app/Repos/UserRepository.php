<?php

namespace App\Repos;


use App\Setting;
use App\Traits\ResponseTrait;
use App\User;

class UserRepository
{
    use ResponseTrait;

    public function forgotPassword()
    {
        $user = \App\User::where('email', \Request::input('email'))->first();
        if ($user == null) {
            $this->response = \Redirect::back()->with('error', tr("we_could_not_find_an_user_with_this_email"));
        } else {
            $password = str_random(16);
            $user->password = bcrypt($password);
            $user->save();
            \Mail::send('email.forgot_password', ["password" => $password, "user" => $user], function ($msg) use ($user) {
                $msg->from(\Config::get('mail.from.address'), Setting::find("site_title")->value);
                $msg->to($user->email, $user->name)->subject(trans("messages.forgot_password"));
            });
            $this->response = \Redirect::to('/')->with('success', tr("We've_sent_you_an_email_with_your_password!"));
        }
    }

    public function create($request)
    {
        $user = new User();
        $user->email = e($request->input('email'));
        $user->name = e($request->input('fname') . " " . $request->input("lname"));
        $user->password = bcrypt($request->input('password'));
        if (\Request::has('ref')) {
            $user->ref = \Crypt::decrypt($request->input('ref'));
        }
        $user->save();
        //Authenticate the user
        \Auth::login($user);
        $this->response = \Redirect::intended('app/dashboard')->with('success', tr("successfully_created_an_account"));
    }
}