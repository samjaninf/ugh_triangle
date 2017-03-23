<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class DoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'do:cron';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $time = strtotime(date("Y-m-d H:i"));
        foreach (Post::where(function ($query) use ($time) {
            $query->where('published', 0)->where('time', $time);
        })->orWhere(function ($query) {
            $query->where('published', 0)->where('publish_type', 0);
        })->with('profile')->get() as $post) {
            $name = \Config::get('publishers.' . $post->profile->type);
            $publisher = new $name();
            $publisher->post($post);
            $post->published = 1;
            $post->save();
        }
    }
}
