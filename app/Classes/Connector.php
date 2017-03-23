<?php
namespace App\Classes;


use App\Events\ProfileWasCreated;
use App\Profile;
use DirkGroenen\Pinterest\Pinterest;
use Facebook\Exceptions\FacebookSDKException;
use Redirect;
use Session;
use Twitter;

class Connector
{
    private $type, $response, $params;

    /**
     * Connector constructor.
     * @param $type
     */
    public function __construct($type, $params = null)
    {
        $this->type = $type;
        if ($params != null) {
            $this->params = $params;
        }
        $this->fb = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

    }


    public function connect()
    {
        if ($this->type == "fb_profile") {
            // Obtain an access token.
            try {
                $token = $this->fb->getAccessTokenFromRedirect();
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }

            // Access token will be null if the user denied the request
            // or if someone just hit this URL outside of the OAuth flow.
            if (!$token) {
                // Get the redirect helper
                $helper = $this->fb->getRedirectLoginHelper();

                if (!$helper->getError()) {
                    abort(403, 'Unauthorized action.');
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
                $oauth_client = $this->fb->getOAuth2Client();

                // Extend the access token.
                try {
                    $token = $oauth_client->getLongLivedAccessToken($token);
                } catch (FacebookSDKException $e) {
                    dd($e->getMessage());
                }
            }

            $this->fb->setDefaultAccessToken($token);
            try {
                $response = $this->fb->get('/me?fields=id,name,email');
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }
            $response = json_decode($response->getBody(), true);
            if (Profile::where('e_id', $response['id'])->where('user_id', \Auth::user()->id)->first() == null) {
                $profile = Profile::create([
                    'access_token' => $token,
                    'user_id' => \Auth::user()->id,
                    'avatar' => 'http://graph.facebook.com/' . $response['id'] . '/picture',
                    'name' => $response['name'],
                    'e_id' => $response['id'],
                    'type' => 'fb_profile'
                ]);
                event(new ProfileWasCreated($profile));
            }

            return redirect('app/dashboard')->with('success', tr('successfully_connected_a_facebook_profile'));

        }
        if ($this->type == "fb_page") {
            $this->fb->setDefaultAccessToken($this->params['page']['access_token']);
            $res = json_decode($this->fb->get($this->params['page']['id'] . '?fields=picture')->getBody(), true);
            if (Profile::where('e_id', $this->params['page']['id'])->where('user_id', \Auth::user()->id)->first() == null) {
                $profile = Profile::create([
                    'user_id' => \Auth::user()->id,
                    'avatar' => $res['picture']['data']['url'],
                    'e_id' => $this->params['page']['id'],
                    'type' => 'fb_page',
                    'name' => $this->params['page']['name'],
                    'access_token' => $this->params['page']['access_token']

                ]);
                event(new ProfileWasCreated($profile));
            }
            return redirect('app/dashboard')->with('success', tr('successfully_connected_a_facebook_page'));
        }
        if ($this->type == "fb_group") {
            if (Profile::where('e_id', $this->params['group']['id'])->where('user_id', \Auth::user()->id)->first() == null) {
                $profile = Profile::create([
                    'user_id' => \Auth::user()->id,
                    'avatar' => 'http://graph.facebook.com/' . $this->params['group']['id'] . '/picture',
                    'e_id' => $this->params['group']['id'],
                    'type' => 'fb_group',
                    'access_token' => $this->params['group']['access_token'],
                    'name' => $this->params['group']['name']

                ]);
                event(new ProfileWasCreated($profile));
            }
            return redirect('app/dashboard')->with('success', 'Успешно свърза фейсбук група');
        }
        if ($this->type == "fb_event") {
            if (Profile::where('e_id', $this->params['event']['id'])->where('user_id', \Auth::user()->id)->first() == null) {
                $profile = Profile::create([
                    'user_id' => \Auth::user()->id,
                    'avatar' => 'http://graph.facebook.com/' . $this->params['event']['id'] . '/picture',
                    'e_id' => $this->params['event']['id'],
                    'access_token' => $this->params['event']['access_token'],
                    'type' => 'fb_event',
                    'name' => $this->params['event']['name']

                ]);
                event(new ProfileWasCreated($profile));
            }
            return redirect('app/dashboard')->with('success', 'Успешно свърза фейсбук събитие');
        }
        if ($this->type == "twitter") {
            // You should set this route on your Twitter Application settings as the callback
            // https://apps.twitter.com/app/YOUR-APP-ID/settings
            if (Session::has('oauth_request_token')) {
                $request_token = [
                    'token' => Session::get('oauth_request_token'),
                    'secret' => Session::get('oauth_request_token_secret'),
                ];

                Twitter::reconfig($request_token);

                $oauth_verifier = false;

                if (\Request::has('oauth_verifier')) {
                    $oauth_verifier = \Request::input('oauth_verifier');
                }

                // getAccessToken() will reset the token for you
                $token = Twitter::getAccessToken($oauth_verifier);

                if (!isset($token['oauth_token_secret'])) {
                    return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
                }

                $credentials = Twitter::getCredentials();
                if (is_object($credentials) && !isset($credentials->error)) {
                    if (Profile::where('e_id', $credentials->id)->where('user_id', \Auth::user()->id)->first() == null) {
                        $profile = Profile::create([
                            'user_id' => \Auth::user()->id,
                            'avatar' => $credentials->profile_image_url,
                            'e_id' => $credentials->id,
                            'access_token' => json_encode([$token['oauth_token'], $token['oauth_token_secret']]),
                            'type' => 'twitter',
                            'name' => $credentials->name

                        ]);
                        event(new ProfileWasCreated($profile));
                    }
                    return redirect('app/dashboard')->with('success', 'Успешно добави туитър профил');
                }

                return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
            }
        }
        if ($this->type == "linkedin") {
            // get data from request
            $code = \Request::get('code');

            $linkedinService = \OAuth::consumer('Linkedin');


            if (!is_null($code)) {
                // This was a callback request from linkedin, get the token
                $token = $linkedinService->requestAccessToken($code);
                // Send a request with it. Please note that XML is the default format.
                $result = json_decode($linkedinService->request('/people/~?format=json'), true);
                $image = json_decode($linkedinService->request('/people/~:(picture-urls::(original))?format=json'), true);
                if ($image["pictureUrls"]["_total"]) {
                    $image = $image["pictureUrls"]["values"][0];
                } else {
                    $image = "http://www.stackle.io/media/img/iconmonstr-linkedin-4-icon-256.png";
                }
                $profile = Profile::where('e_id', $result['id'])->where('user_id', \Auth::user()->id)->first();
                if ($profile == null) {
                    $profile = Profile::create([
                        'user_id' => \Auth::user()->id,
                        'avatar' => $image,
                        'e_id' => $result['id'],
                        'access_token' => $token->getAccessToken(),
                        'type' => 'linkedin_profile',
                        'name' => $result['firstName'] . " " . $result['lastName']

                    ]);
                    event(new ProfileWasCreated($profile));
                } else {
                    $profile->access_token = $token->getAccessToken();
                    $profile->save();
                }
                return redirect('app/dashboard')->with('success', 'Успешно добави LinkedIn профил');

            } // if not ask for permission first
            else {
                // get linkedinService authorization
                $url = $linkedinService->getAuthorizationUri(['state' => 'DCEEFWF45453sdffef424']);

                // return to linkedin login url
                return redirect((string)$url);
            }
        }
        if ($this->type == "pinterest") {
            $pinterest = new Pinterest(\Config::get('oauth-5-laravel.consumers.Pinterest.client_id'), \Config::get('oauth-5-laravel.consumers.Pinterest.client_secret'));
            $pinterest->auth->setOAuthToken(\Request::get('access_token'));
            $user = $pinterest->users->me();
            $profile = Profile::where('e_id', $user->id)->where('user_id', \Auth::user()->id)->first();
            if ($profile == null) {
                $profile = Profile::create([
                    'user_id' => \Auth::user()->id,
                    'avatar' => "",
                    'e_id' => $user->id,
                    'access_token' => \Request::get('access_token'),
                    'type' => 'pinterest',
                    'name' => $user->first_name . " " . $user->last_name

                ]);
                event(new ProfileWasCreated($profile));
            } else {
                $profile->access_token = \Request::get('access_token');
                $profile->save();
            }
            return redirect('app/pinterest/boards')->with('success', 'Успешно свърза твоят Pinterest акаунт!');
        }
        if ($this->type == "pinterest_board") {
            $pinterest = new Pinterest(\Config::get('oauth-5-laravel.consumers.Pinterest.client_id'), \Config::get('oauth-5-laravel.consumers.Pinterest.client_secret'));
            $profile = Profile::findOrFail(\Request::input('info')['profile']);
            $pinterest->auth->setOAuthToken($profile->access_token);
            $info = \Request::input('info');
            $pr = Profile::where('e_id', $info['id'])->where('user_id', \Auth::user()->id)->first();
            if ($pr == null) {
                $profile = Profile::create([
                    'user_id' => \Auth::user()->id,
                    'avatar' => $info['image'] == null ? url('assets/img/shortcuts/pinterest.png') : $info['image'],
                    'e_id' => $info['id'],
                    'access_token' => $profile->access_token,
                    'type' => 'pinterest_board',
                    'name' => $info['name']

                ]);
                event(new ProfileWasCreated($profile));
            }

            return redirect('app/dashboard')->with('success', 'Успешно свърза Pinterest Board към твоят акаунт!');
        }
        if ($this->type == "linkedin_page") {
            $info = \Request::input('info');
            $profile = Profile::findOrFail($info['p_id']);
            $pr = Profile::where('e_id', $info['id'])->where('user_id', \Auth::user()->id)->where('type', $this->type)->first();
            if ($pr == null) {
                $profile = Profile::create([
                    'user_id' => \Auth::user()->id,
                    'avatar' => $profile->avatar,
                    'e_id' => $info['id'],
                    'access_token' => $profile->access_token,
                    'type' => 'linkedin_page',
                    'name' => $info['name']

                ]);
                event(new ProfileWasCreated($profile));
            } else {
                $pr->access_token = $profile->access_token;
                $pr->save();
            }
            return redirect('app/dashboard')->with('success', 'Успешно добави LinkedIn страница!');
        }

    }

}