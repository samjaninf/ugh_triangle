<?php
namespace App\Classes;


class Profile
{

    public function update($request)
    {
        $user = \Auth::user();
        $user->name = e($request->input('name'));
        $user->email = e($request->input('email'));
        $user->save();
    }


}