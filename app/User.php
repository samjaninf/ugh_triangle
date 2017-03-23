<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SyncableGraphNodeTrait;

    protected static $graph_node_fillable_fields = ["name", "id", "fb_id"];
    protected static $graph_node_field_aliases = [
        'id' => 'fb_id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static function getLoginCreds()
    {
        return [
            "email" => \Request::input('email'),
            "password" => \Request::input('password'),
            "fb_id" => "",
            "gp_id" => "",
            "twitter_id" => ""
        ];
    }

    public function parent_account()
    {
        if ($this->ref) {
            return $this->belongsTo('App\User', 'ref');
        } else {
            return null;
        }
    }

    public function getTwitterAccount()
    {
        return Profile::own()->where('type', 'twitter')->first();
    }

    public function getLimits()
    {
        return [
            "profile" => 10,
            "posts" => 50,
            "members" => 5
        ];
    }

    public function getAvatar()
    {
        if ($this->avatar == "") {
            return url('t_assets') . "/images/users/avatar-1.jpg";
        } else {
            return $this->avatar;
        }
    }

    public function getScheduledPostsNum()
    {
        $posts = Post::own()->where('time', '>', time())->where('published', 0)->count();
        return $posts;
    }

    public function getProfiles()
    {
        $ids[] = \Auth::user()->id;
        foreach ($this->getTeamMembers() as $member) {
            $ids[] = $member->id;
        }
        $profiles = Profile::whereIn('user_id', $ids)->get();
        return $profiles;
    }

    public function getTeamMembers()
    {
        $ref = \Auth::user()->ref == 0 ? \Auth::user()->id : \Auth::user()->ref;
        $users = User::where(function ($query) use ($ref) {
            $query->where('ref', $ref)->orWhere('id', $ref);
        })->where('id', '<>', \Auth::user()->id)->get();
        return $users;
    }

    public function getNotificationsCount()
    {
        return $this->notifications()->where('is_read', 0)->count();
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'user_id');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation', 'to_user_id');
    }

    public function hasFacebookProfile()
    {
        return $this->profiles()->where('type', 'fb_profile')->count();
    }

    public function profiles()
    {
        return $this->hasMany('App\Profile', 'user_id');
    }

    public function hasLinkedInProfile()
    {
        return $this->profiles()->where('type', 'linkedin_profile')->count();
    }
}
