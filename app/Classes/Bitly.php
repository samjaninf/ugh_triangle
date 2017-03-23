<?php
namespace App\Classes;

use App\Bitly as BitlyModel;
use App\Profile;

class Bitly
{

    // Stores the response of the request
    private $response;

    /**
     * Connects a social profile with a bit.ly account
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function connect($request)
    {
        if (!\Session::has('bitly_profile')) {
            $this->response = \Redirect::back();
        }
        // get data from request
        $code = $request->get('code');
        // gets the profile from the session
        $profile = \Session::get('bitly_profile');
        // get google service
        $bitly = \OAuth::consumer('Bitly');

        // check if code is valid
        // if code is provided get user data and sign in
        if (!empty($code)) {
            // This was a callback request from twitter, get the token
            $token = $bitly->requestAccessToken($code);
            // decodes the user's json data
            $result = json_decode($bitly->request('user/info'), true);
            // checks if this profile has already been connected
            $p = BitlyModel::where('bitly_id', $result['data']['login'])->where('profile_id', $profile->id)->first();
            if ($p == null) {
                BitlyModel::create([
                    'bitly_id' => $result['data']['login'],
                    'access_token' => $token->getAccessToken(),
                    'profile_id' => $profile->id
                ]);
            } else {
                $p->access_token = $token->getAccessToken();
                $p->save();
            }
            $this->response = \Redirect::to('app/bitly')->with('success', 'Успешно свърза твоят Bit.ly акаунт');
        } // if not ask for permission first
        else {
            // get request token
            $url = $bitly->getAuthorizationUri();

            $this->response = redirect((string)$url);
        }
    }

    public function connectAll($request)
    {
        $code = $request->get('code');
        $profile = \Session::get('bitly_profile');
        // get google service
        $bitly = \OAuth::consumer('Bitly');

        // check if code is valid
        // if code is provided get user data and sign in
        if (!empty($code)) {
            // This was a callback request from twitter, get the token
            $token = $bitly->requestAccessToken($code);
            $result = json_decode($bitly->request('user/info'), true);
            foreach (Profile::where('user_id', \Auth::user()->id)->get() as $profile) {
                BitlyModel::create([
                    'bitly_id' => $result['data']['login'],
                    'access_token' => $token->getAccessToken(),
                    'profile_id' => $profile->id
                ]);
            }
            $this->response = \Redirect::to('app/bitly')->with('success', tr('successfully_connected_your_bitly_account_to_all_your_profiles'));
        } // if not ask for permission first
        else {
            // get request token
            $url = $bitly->getAuthorizationUri();

            // return to twitter login url
            $this->response = redirect((string)$url);
        }
    }

    public function getResponse()
    {
        return $this->response;
    }

}