<?php

namespace App\Http\Controllers\App;

use App\Bitly;
use App\Classes\Bitly as BitlyConnector;
use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;

class BitlyController extends Controller
{
    private $bitlyConnector;

    public function __construct()
    {
        $this->bitlyConnector = new BitlyConnector();
    }

    /*
        Shows all your profiles with bit.ly option
    */
    public function index()
    {
        $profiles = Profile::where('user_id', \Auth::user()->id)->with('bitly')->get();
        return view('app.bitlys', compact('profiles'));
    }

    /*
     * Pre-connecting request to the bit.ly profile
     */
    public function preConnect($pid)
    {
        $profile = Profile::findOrFail($pid);
        \Session::forget('bitly_profile');
        \Session::put('bitly_profile', $profile);
        return \Redirect::to('app/connect/bitly');
    }

    /*
     * Method that connects all profiles
     */
    public function connectAll(Request $request)
    {
        $this->bitlyConnector->connectAll($request);
        return $this->bitlyConnector->getResponse();
    }

    public function connect(Request $request)
    {
        $this->bitlyConnector->connect($request);
        return $this->bitlyConnector->getResponse();
    }

    public function disconnect($pid)
    {
        $profile = Profile::findOrFail($pid);
        Bitly::where('profile_id', $pid)->delete();
        return \Redirect::back()->with('success', tr('successfully_removed_the_bitly_account'));
    }
}
