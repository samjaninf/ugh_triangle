<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    protected $guarded = [];

    public static function doSave()
    {
        $draft = new Draft();
        $draft->text = e(\Request::input('text'));
        $draft->user_id = \Auth::user()->id;
        $draft->save();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeOwn($query)
    {
        $members = \Auth::user()->getTeamMembers();
        $ids = [\Auth::user()->id];
        foreach ($members as $member) {
            $ids[] = $member->id;
        }
        return $query->whereIn('user_id', $ids);
    }
}
