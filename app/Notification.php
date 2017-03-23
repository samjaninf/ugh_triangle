<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function seen()
    {
        $this->is_read = 1;
        $this->save();
    }

    public function scopeOwn($query)
    {
        $query->where('user_id', \Auth::user()->id);
    }
}
