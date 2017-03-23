<?php

namespace App\Events;

use App\Post;
use App\User;
use Illuminate\Queue\SerializesModels;

class NewPostHasBeenCreated extends Event
{
    use SerializesModels;

    // Contains the post model
    public $post;
    // Contains the user model ( The published )
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }
}
