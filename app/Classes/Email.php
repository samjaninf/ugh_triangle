<?php
namespace App\Classes;


use App\User;

class Email
{


    /**
     * Checks if the given {$email} is valid
     * @param $email
     * @return bool
     */
    public static function isValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sends an e-mail request to the given {$email}
     * @param $email
     * @return array
     */
    public static function sendTeamRequest($email)
    {
        if (self::canJoinTeam($email) == false) return ["Упс", "Този потребител е част от друг екип", "error"];
        // Sends an e-mail to the user
        $status = \Mail::send('email.team_request', ['email' => $email, 'user' => \Auth::user()], function ($mail) use ($email) {
            $mail->from('imcodecanyon@gmail.com', 'Triangle');
            $mail->to($email)->subject("Triangle - Покана за присъединяване");
        });
        //Checks the status of the e-mail
        if ($status) {
            return ["Йейй", "Успешно изпратихте заявка за присъединяване", 'success'];
        } else {
            return ["Упс", "Нещо се обърка докато изпращахме поканата, опитайте отново!", "error"];
        }
    }

    /**
     * Checks if there is an user with this email
     * and if there is a possibility to join a team
     * @param $email
     * @return bool
     */
    public static function canJoiNTeam($email)
    {
        $can = true;
        $user = User::where('email', $email)->first();
        if ($user->ref != 0) $can = false;
        return $can;
    }

}