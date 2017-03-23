<?php
namespace App\Classes;


use Request;

class User
{

    public static function save(\App\User $user, $request, $edit = null)
    {
        $user->is_admin = Request::has('is_admin');
        $user->name = e($request->input('fname') . " " . $request->input("lname"));
        $user->password = $edit ? ($request->input('password') == "" ? $user->password : bcrypt($request->input("password"))) : bcrypt($request->input('password'));
        $user->email = e($request->input('email'));
        $user->save();
    }

}