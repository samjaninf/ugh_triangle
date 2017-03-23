<?php

namespace App\Handlers\Events;

use App\Events\ProfileWasCreated;
use App\PTime;

class CreateSchedules
{
    /**
     * @param ProfileWasCreated $event
     */
    public function handle(ProfileWasCreated $event)
    {
        $user = $event->profile;
        foreach (\Config::get('ptimes') as $ptime) {
            PTime::firstOrCreate([
                'profile_id' => $user->id,
                'day' => $ptime['day'],
                'minute' => $ptime['minute'],
                'hour' => $ptime['hour'],
                'timestamp' => ($ptime['day'] * 86400) + ($ptime['minute'] * 60) + ($ptime['hour'] * 3600)
            ]);
        }
    }
}
