<?php

namespace App\Http\Controllers\App;

use App\Classes\Email;
use App\Classes\NotificationSender;
use App\Contracts\InvitationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    /**
     * Displays "Team" page with all users and invitations
     * @return mixed
     */
    public function index()
    {
        // Get all invitations that have not been answered
        $invitations = \Auth::user()->invitations()->notAnswered()->get();
        return view('app.team.index', ['invitationsRequests' => $invitations]);
    }


    /**
     * Sends an invitation for joining the team
     * @param Request $request
     * @return array
     */
    public function add(Request $request, InvitationRepositoryInterface $repository)
    {
        if (Email::isValid($request->input('email'))) {
            $repository->create($request->input('email'));
            $status = Email::sendTeamRequest($request->input('email'));
            return $status;
        } else {
            return [tr('oops'), tr('invalid_email'), "error"];
        }
    }


    /**
     * Searchs for members in the team
     * @return mixed
     */
    public function search()
    {
        $ref = \Auth::user()->ref == 0 ? \Auth::user()->id : \Auth::user()->ref;
        $users = User::where('name', 'LIKE', '%' . \Request::input('search') . '%')->where(function ($query) use ($ref) {
            $query->where('ref', $ref)->orWhere('id', $ref);
        })->where('id', '<>', \Auth::user()->id)->get();
        foreach ($users as &$user) {
            $user->avatar = $user->getAvatar();
        }
        return $users;
    }


    /**
     * Removing a member from the team
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $user = User::findOrfail($id);
        $user->ref = 0;
        $user->save();
        return \Redirect::back()->with('success', tr('successfully_removed_the_user_from_the_team'));
    }

    /*
    Leave the team
    */
    public function leave()
    {
        $user = \Auth::user();
        foreach (\Auth::user()->getTeamMembers() as $member) {
            NotificationSender::send($member, [
                "title" => $user->name . " напусна екипа",
                "description" => $user->name . " напсуна екипа",
                "icon" => "sign-out",
                "link" => route('team.index')
            ]);
        }
        $user->ref = 0;
        $user->save();
        return \Redirect::to('app/dashboard')->with('success', 'Успешно напусна екипа');
    }

}
