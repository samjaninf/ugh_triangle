<?php
namespace App\Classes;


use App\Profile;

class SocialProfile
{

    public static function turn()
    {
        $profile = Profile::findOrFail(\Request::input('id'));
        $type = \Request::input('state');
        if ($type) {
            $profile->is_active = 1;
        } else {
            $profile->is_active = 0;
        }
        $profile->save();
    }

    public static function update(Profile $profile)
    {
        $profile->name = e(\Request::input('name'));
        $profile->description = e(\Request::input('description'));
        $profile->save();
    }

}