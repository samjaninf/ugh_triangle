<?php
namespace App\Http\Controllers\App;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddMemberFormRequest;
use App\User;

class MembersController extends Controller
{

    public function index()
    {
        $members = User::where('ref', \Auth::user()->id)->get();
        return view('app.team.index', compact('members'));
    }

    public function add(AddMemberFormRequest $request)
    {
        if (User::where('ref', \Auth::user()->id)->count() >= \Auth::user()->getLimits()['members']) {
            return \Redirect::back()->with('error', 'You have reached your team members limit, you can not add more members until you extend your membership');
        }
        \Mail::send('email.invitation', ['user' => \Auth::user()], function ($query) use ($request) {
            $query->to($request->input('email'));
            $query->from(\Config::get('mail.from.address'), \Config::get('mail.form.name'))->subject("Invitation");
        });
        return \Redirect::back()->with('success', 'Invitation Successfully Sent');
    }


}