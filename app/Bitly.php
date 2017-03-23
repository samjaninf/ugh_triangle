<?php

namespace App;

use Hpatoio\Bitly\Client;
use Illuminate\Database\Eloquent\Model;

class Bitly extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'bitlys';

    public function short($link)
    {
        $shortener = new Client($this->access_token);
        $r = $shortener->Shorten(['longUrl' => $link]);
        return $r['url'];
    }
}
