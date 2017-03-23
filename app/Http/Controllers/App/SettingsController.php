<?php

namespace App\Http\Controllers\App;

use App\Classes\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class SettingsController extends Controller
{
    private $profile;

    /**
     * SettingsController constructor.
     * @param $profile
     */
    public function __construct()
    {
        $this->profile = new Profile();
    }

    public function index()
    {
        return view('app.settings');
    }

    public function switchLang($lang)
    {
        \Session::put('lang', $lang);
        return \Redirect::back();
    }

    public function update(Requests\UpdateProfileFormRequest $request)
    {
        $this->profile->update($request);
        return \Redirect::back()->with('success', trans("messages.profile_successfully_updated"));
    }

    public function changePassword(Requests\ChangePassword $request)
    {
        $user = \Auth::user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();
        return \Redirect::back()->with('success', trans('messages.password_successfully_changed'));
    }
}
