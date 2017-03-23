<?php
namespace App\Repos;


use App\Classes\Email;
use App\Classes\NotificationSender;
use App\Contracts\InvitationRepositoryInterface;
use App\Invitation;
use App\User;

class InvitationRepository implements InvitationRepositoryInterface
{

    /*
     * Creates a repository
     */
    public function create($email)
    {
        $user = User::where('email', $email)->first();
        if (Email::canJoiNTeam($email) && $user != null) {
            $invitation = new Invitation();
            $invitation->from_user_id = \Auth::user()->id;
            $invitation->to_user_id = $user->id;
            $invitation->save();
            $this->sendNotification($user, [
                "title" => tr('invitation_request'),
                "description" => tr(':username_sent_you_a_request'),
                "icon" => "envelope-o",
                "link" => route("team.index")
            ]);
        }
    }

    /*
     * Sends an notification to the user
     */
    public function sendNotification($user, $data)
    {
        NotificationSender::send($user, $data);
    }

    /*
     * Accepts the invitation request
     */
    public function accept(Invitation $invitation)
    {
        $invitation->status = 1;
        $invitation->save();
        $user = \Auth::user();
        $user->ref = $invitation->from_user_id;
        $user->save();
        $user->invitations()->delete();
        $this->sendNotification($invitation->sender, [
            "title" => tr('invitation_acccepted'),
            "description" => tr(':username_acccepted_your_invitation'),
            "icon" => "check",
            "link" => route("team.index")
        ]);
    }

    /*
    * Declines the invitation request
     */
    public function decline(Invitation $invitation)
    {
        $invitation->status = 2;
        $invitation->save();
        $this->sendNotification($invitation->sender, [
            "title" => tr('invitation_declined'),
            "description" => tr(':username_declined_your_invitation'),
            "icon" => "times",
            "link" => route("team.index")
        ]);
    }
}