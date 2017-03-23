<?php

namespace App\Handlers\Events;

use App\Classes\NotificationSender;
use App\Events\NewPostHasBeenCreated;

class SendNotificationToTheTeam
{
    /**
     * Handle the event.
     *
     * @param  NewPostHasBeenCreated $event
     * @return void
     */
    public function handle(NewPostHasBeenCreated $event)
    {
        $user = $event->user;
        foreach ($user->getTeamMembers() as $member) {
            $scheduleWord = "публикува";
            if ($event->post->time > time() && $event->post->published == false) {
                $scheduleWord = "насрочи публикация";
            }
            $userName = $user->name;
            $profileName = $event->post->profile->getNameType();
            $date = date("Y-m-d H:i:s", $event->post->time);
            NotificationSender::send($member, [
                "title" => "{$userName} {$scheduleWord} чрез {$profileName}",
                "description" => "Време на публикация: {$date}",
                "icon" => "bell",
                "link" => route("publishing")
            ]);
        }
    }
}
