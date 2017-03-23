<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ProfileWasCreated extends Event
{
    use SerializesModels;
    public $profile;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
