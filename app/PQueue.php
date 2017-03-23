<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class PQueue extends Model
{

    public $timestamps = false;
    protected $table = 'publishing_queue';
    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'profile_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

}