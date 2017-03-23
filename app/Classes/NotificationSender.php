<?php
namespace App\Classes;


use App\Notification;
use App\User;

class NotificationSender
{

    /*
     * Creates a notification and prepares the sockets
     */
    public static function send(User $user, $requestData)
    {

        Notification::create([
            "user_id" => $user->id,
            "title" => $requestData["title"],
            "icon" => $requestData["icon"],
            "link" => $requestData["link"],
            "description" => $requestData["description"],
            "is_read" => 0
        ]);
        $data = [];
        if (\Session::has('execute')) {
            $data += \Session::get('execute');
        }
        $data[] = json_encode([
            "to_user" => $user->id,
            "name" => "sendNotification",
            "title" => $requestData["title"],
            "description" => $requestData["description"]
        ]);
        \Session::flash('execute', $data);

    }

}