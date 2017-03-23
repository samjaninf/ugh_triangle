<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function update()
    {
        $data = \Request::input('s');
        foreach ($data as $key => $value) {
            $s = Setting::find($key);
            $s->value = $value;
            $s->save();
        }
        $match = [
            "fb_api_key" => "FACEBOOK_APP_ID",
            "fb_api_secret" => 'FACEBOOK_APP_SECRET',
            "twitter_api_key" => "TWITTER_CLIENT_ID",
            "twitter_api_secret" => 'TWITTER_CLIENT_SECRET',
            "linkedin_api_key" => "LINKEDIN_CLIENT_ID",
            "linkedin_api_secret" => 'LINKEDIN_CLIENT_SECRET',
            "bitly_api_key" => "BITLY_CLIENT_ID",
            "bitly_api_secret" => 'BITLY_CLIENT_SECRET',
        ];
        $match = array_flip($match);
        $file = file_get_contents(base_path('.env'));
        $file = explode("\n", $file);
        $keys = \Request::input('keys');
        foreach ($keys as $key => $value) {
            $s = Setting::find($key);
            $s->value = $value;
            $s->save();
        }
        foreach ($file as $key => $f) {
            if ($f == "") unset($file[$key]);
            $f = explode("=", $f);
            if (in_array($f[0], array_keys($match))) {
                if (\Request::input("keys." . $match[$f[0]]) != "") {
                    $f[1] = \Request::input("keys." . $match[$f[0]]);
                }
            }
            if (isset($f[1]))
                $file[$key] = $f[0] . "=" . $f[1];
        }
        $file = implode("\n", $file);
        \File::put(base_path(".env"), $file);
        return \Redirect::back()->with('success', tr("settings_updated_successfully"));
    }

}
