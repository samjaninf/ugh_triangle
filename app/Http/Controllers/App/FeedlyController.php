<?php
namespace App\Http\Controllers\App;


use App\Http\Controllers\Controller;
use Guzzle\Http\Client;

class FeedlyController extends Controller
{

    public function authenticate()
    {
        $guzzle = new Client();
        $res = $guzzle->get('https://cloud.feedly.com/v3/auth/token', [
            'Authorization' => 'OAuth AygopqoLwNsU3Pp4CUCPo4yPi2qFry5f20RfGL2mLw631RnEzcx_Z4peE_OoxgI7xoDzkDDDL5dR'
        ]);
        dd($res->getResponse());
    }

}