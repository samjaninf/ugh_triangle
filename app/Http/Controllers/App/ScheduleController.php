<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Profile;
use App\PTime;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function select()
    {
        $profiles = Profile::where('user_id', \Auth::user()->id)->get();
        return view('app.ptimes', compact('profiles'));
    }


    public function store($pid, Request $request)
    {
        $profile = Profile::findOrFail($pid);
        PTime::firstOrCreate([
            'profile_id' => $profile->id,
            'day' => $request->input('day'),
            'minute' => $request->input('minute'),
            'hour' => $request->input('hour'),
            'timestamp' => ($request->input('day') * 86400) + ($request->input('hour') * 3600) + ($request->input('minute') * 60)
        ]);
        return \Redirect::back()->with('success', tr("successfully_added_new_time"));
    }

    public function destroy($id)
    {
        $ptime = PTime::findOrFail($id);
        $ptime->delete();
        return \Redirect::back();
    }


}
