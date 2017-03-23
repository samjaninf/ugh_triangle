<?php
namespace App\Repos\Api;


use App\Contracts\TwitterRepositoryInterface;
use App\Profile;
use App\User;

class TwitterRepository implements TwitterRepositoryInterface
{

    public function delete($post)
    {

    }

    /*
     * Twitter Authentication Logic
     */
    public function login($request)
    {
        $authToken = $request->get('oauth_token');
        $authVerifier = $request->get('oauth_verifier');
        $tw = \OAuth::consumer('Twitter');
        if (!is_null($authToken) && !is_null($authVerifier)) {
            $authToken = $tw->requestAccessToken($authToken, $authVerifier);
            $result = json_decode($tw->request('account/verify_credentials.json'), true);
            $u = User::where('twitter_id', $result['id'])->first();
            if ($u == null) {

                // If there is no new user -> creates a new one
                $user = new User();
                $user->name = $result['name'];
                $user->twitter_id = $result['id'];
                $user->avatar = $result["profile_image_url"];
                $user->save();

                // Authenticates the new user
                \Auth::login($user);
                // Redirects the new user to the dashboard
                return \Redirect::to('app/dashboard');
            } else {
                // Authenticates the existing user to the dashbaord
                \Auth::login($u);
                // Redirects the user to the dashboard
                return \Redirect::to('app/dashboard');
            }
        } else {
            // get the twitter api request token
            $reqToken = $tw->requestRequestToken();
            // get's the URI
            $url = $tw->getAuthorizationUri(['oauth_token' => $reqToken->getRequestToken()]);

            // redirects to the twitter login url
            return redirect((string)$url);
        }
    }

    public function getFeeds(Profile $profile)
    {
        \Session::put('access_token', ["oauth_token" => json_decode($profile->access_token)[0], "oauth_token_secret" => json_decode($profile->access_token)[1]]);
        return \Twitter::getHomeTimeline(['count' => 20, 'format' => 'array']);
    }
}