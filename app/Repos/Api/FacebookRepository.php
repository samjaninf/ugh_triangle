<?php
/**
 * Created by PhpStorm.
 * User: Ioan
 * Date: 3/22/2016
 * Time: 11:09 AM
 */

namespace App\Repos\Api;


use App\Classes\Connector;
use App\Contracts\FacebookRepositoryInterface;
use App\Profile;
use App\User;
use Facebook\Exceptions\FacebookSDKException;

class FacebookRepository implements FacebookRepositoryInterface
{
    private $sdk;

    public function __construct()
    {
        $this->sdk = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
    }

    public function getPageInsights(Profile $profile)
    {
        $this->sdk->setDefaultAccessToken($profile->access_token);
        $query = http_build_query([
            "metric" => [
                "page_fans",
                "page_stories",
                "page_views_total",
                "page_engaged_users",
                "page_actions_post_reactions_total",
            ]
        ]);
        $res = $this->sdk->get("/" . $profile->e_id . "/insights?" . $query);
        $data = json_decode($res->getBody(), true)["data"];
        $arr = [];
        foreach ($data as $key => $value) {
            if (isset($value['values'][2]["value"])) {
                $arr[$value['name']] = $value['values'][2]["value"];
            }
        }
        return $arr;
    }

    public function delete($post)
    {
        if ($post->published) {
            $this->sdk->setDefaultAccessToken($post->profile->access_token);
            $this->sdk->delete("/" . $post->post_id);
        }
    }

    public function comment($post, $comment)
    {
        if ($post->published) {
            \Cache::forget('post-comments.' . $post->id);
            $this->sdk->setDefaultAccessToken($post->profile->access_token);
            $res = $this->sdk->post('/' . $post->post_id . '/comments', [
                "message" => $comment
            ]);
        }
    }

    public function analyze(Profile $profile)
    {
        $this->sdk->setDefaultAccessToken($profile->access_token);
        $response = $this->sdk->get('/' . $profile->e_id . '/posts');
        $response = json_decode($response->getBody(), true);
        return $response;
        # Should get /{post}/likes and get the best post times
    }

    public function login($request)
    {

        if (\Auth::check()) {
            $connector = new Connector("fb_profile");
            return $connector->connect();
        } else {
            // Obtain an access token.
            try {
                $token = $this->sdk->getAccessTokenFromRedirect();
            } catch (FacebookSDKException $e) {
                return \Redirect::to('/')->with('error', 'Възникна грешка, опитай отново!');
            }

            // Access token will be null if the user denied the request
            // or if someone just hit this URL outside of the OAuth flow.
            if (!$token) {
                // Get the redirect helper
                $helper = $this->sdk->getRedirectLoginHelper();

                if (!$helper->getError()) {
                    return \Redirect::to('/')->with('error', 'Възникна грешка 403, опитай отново!');
                }

                // User denied the request
                dd(
                    $helper->getError(),
                    $helper->getErrorCode(),
                    $helper->getErrorReason(),
                    $helper->getErrorDescription()
                );
            }

            if (!$token->isLongLived()) {
                // OAuth 2.0 client handler
                $oauth_client = $this->sdk->getOAuth2Client();

                // Extend the access token.
                try {
                    $token = $oauth_client->getLongLivedAccessToken($token);
                } catch (FacebookSDKException $e) {
                    return \Redirect::to('/')->with('error', 'Възникна грешка, опитай отново!');
                }
            }

            $this->sdk->setDefaultAccessToken($token);

            // Save for later
            \Session::put('fb_user_access_token', (string)$token);

            // Get basic info on the user from Facebook.
            try {
                $response = $this->sdk->get('/me?fields=id,name,email,picture&type=large');
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
            // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
            $facebook_user = $response->getGraphUser();
            // This will only work if you've added the SyncableGraphNodeTrait to your User model.
            $user = User::createOrUpdateGraphNode($facebook_user);
            if ($user->avatar == "") {
                $user->avatar = json_decode($response->getBody(), true)["picture"]["data"]["url"];
                $user->save();
            }

            // Log the user into Laravel
            \Auth::login($user);
            return redirect('app/dashboard')->with('message', 'Successfully logged in with Facebook');
        }
    }
}