<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $guarded = [];

    public function scopeNotAnswered($query)
    {
        return $query->where('status', 0);
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }
}
