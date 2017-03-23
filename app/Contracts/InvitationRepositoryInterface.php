<?php
namespace App\Contracts;


use App\Invitation;

interface InvitationRepositoryInterface
{

    /**
     * @param $email
     * @return mixed
     */
    public function create($email);

    /**
     * @param $user
     * @param $data
     * @return mixed
     */
    public function sendNotification($user, $data);

    /**
     * @param Invitation $invitation
     * @return mixed
     */
    public function accept(Invitation $invitation);

    /**
     * @param Invitation $invitation
     * @return mixed
     */
    public function decline(Invitation $invitation);

}