<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Profile;

class WatermarkController extends Controller
{

    public function selectProfile()
    {
        $profiles = \Auth::user()->getProfiles();
        return view('app.watermark_profile_select', compact('profiles'));
    }

    public function index($id)
    {
        $profile = Profile::findOrFail($id);
        if (\Request::has('img') == false && $profile->watermark != "") {
            $x = json_decode($profile->w_paddings, true)["left"];
            $y = json_decode($profile->w_paddings, true)["top"];
            return \Redirect::to('app/watermark/' . $profile->id . '?img=1&url=' . $profile->watermark_o . '&ratio=' . ($profile->w_width / $profile->w_height) . '&height=' . $profile->w_height . '&width=' . $profile->w_width . '&opacity=' . $profile->w_opacity . '&x=' . $x . '&y=' . $y);
        }
        return view('app.watermark', compact('profile'));
    }

    public function upload($id)
    {
        $profile = Profile::findOrFail($id);
        $file = \Request::file('file');
        $file->move('uploads', $file->getClientOriginalName());
        $sizes = getimagesize(public_path('uploads/' . $file->getClientOriginalName()));
        $str = http_build_query([
            'url' => url('uploads/' . $file->getClientOriginalName()),
            'ratio' => $sizes[0] / $sizes[1]
        ]);
        return \Redirect::to('app/watermark/' . $profile->id . '?img=1&' . $str);
    }

    public function update(Requests\UpdateWatermarkRequest $req, $id)
    {
        $img = \Request::input('img');
        $profile = Profile::findOrFail($id);
        $img = \Request::input('img');
        $profile->watermark_o = $img['src'];
        //Make an image
        $n_image = \Image::make($profile->watermark_o);
        //Resize the image
        $n_image->resize($img['width'], $img['height']);
        //Put the opacity
        $n_image->opacity($img['opacity'] * 100);
        //Get the extension
        $ext = explode(".", $img['src']);
        $ext = $ext[count($ext) - 1];
        //New watermark name
        $p_name = $profile->id . "_watermark.png";
        //Saving the watermark
        $n_image->save(public_path("pics/" . $p_name));

        //Settings the fields
        $profile->watermark = url("pics/" . $p_name);
        //Image width
        $profile->w_width = $img['width'];
        //Opacity
        $profile->w_opacity = $img['opacity'] * 100;
        //Width percent
        $profile->width_perc = $img['width_perc'];
        //Top & Left paddings
        $profile->w_paddings = $img['paddings'];
        //Height
        $profile->w_height = $img['height'];
        $profile->save();
        return \Redirect::to('app/watermark/' . $profile->id)->with('success', 'Profile watermark successfully updated');

    }

}
