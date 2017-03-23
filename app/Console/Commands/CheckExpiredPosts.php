<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class CheckExpiredPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for expired posts.';

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
        $sdk = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $posts = \DB::table('posts')
            ->where('post_id', '<>', '')
            ->where('published', 1)
            ->join('profiles', function ($join) {
                $join->on('posts.profile_id', '=', 'profiles.id')
                    ->where('profiles.type', 'LIKE', 'fb_%');
            })
            ->select('posts.*', 'profiles.type')
            ->get();
        foreach ($posts as $post) {

            $postObject = Post::find($post->id);
            $sdk->setDefaultAccessToken($postObject->profile->access_token);
            try {
                $res = $sdk->get('/' . $postObject->post_id);
            } catch (\Exception $e) {
                echo "POST #" . $postObject->id . " - DELETED";
                $postObject->delete();
            }
        }
    }
}
