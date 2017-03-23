<?php
namespace App\Http\Controllers\App;

use App\Classes\Cacher;
use App\Contracts\TwitterRepositoryInterface as TwitterRepository;
use App\Http\Controllers\Controller;

class FeedsController extends Controller
{

    /*
     * RSS feeds index page
     */
    public function index()
    {
        return view('app.feeds.index');
    }


    /*
     * Twitter Feeds
     */
    public function twitter(TwitterRepository $repo)
    {
        $twitterAccount = \Auth::user()->getTwitterAccount();
        $feeds = $twitterAccount != null ? Cacher::cache("twitterFeed" . $twitterAccount->id, function () use ($twitterAccount, $repo) {
            return $repo->getFeeds($twitterAccount);
        }) : [];
        return view('app.feeds.twitter', compact('twitterAccount', 'feeds'));
    }

    /*
     * Changes the twitter account
     */
    public function twitterChange()
    {

    }

}