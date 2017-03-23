<?php
namespace App\Http\Controllers\App;


use App\Classes\SocialProfile;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Repos\Api\FacebookRepository;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->repo = \App::make(FacebookRepository::class);
    }

    public function turn()
    {
        if (\Request::ajax()) {
            SocialProfile::turn();
            return "Success";
        }
    }

    public function analyze($id)
    {
        $profile = Profile::find($id);
        $result = $this->repo->analyze($profile);
        dd($result);
    }

    public function update($id)
    {
        $profile = Profile::find($id);
        SocialProfile::update($profile);
        return \Redirect::back()->with('success', "Успешно обнови профила");
    }

    public function connect()
    {
        return view('app.profile.connect');
    }

    public function show($id)
    {
        $profile = Profile::find($id);
        $posts = \App\Post::where('profile_id', $id)->orderBy('time', 'DESC')->get();
        return view('app.profile.show', compact('profile', 'posts'));
    }

    public function delete($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return \Redirect::to('app/dashboard')->with('success', 'Успешно изтри твоят профил');
    }

}