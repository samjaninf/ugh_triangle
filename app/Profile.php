<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    public $timestamps = false;
    protected $guarded = [];

    public function ptimes()
    {
        return $this->hasMany('App\PTime');
    }

    public function scopeOwn($query)
    {
        $ids[] = \Auth::user()->id;
        foreach (\Auth::user()->getTeamMembers() as $member) {
            $ids[] = $member->id;
        }
        return $query->whereIn('user_id', $ids);
    }


    public function getNameType()
    {
        switch ($this->type) {
            case "fb_profile":
                return "Fb Profile";
            case "fb_page":
                return "Fb Page";
            case "fb_group":
                return "Fb Group";
            case "fb_event":
                return "Fb Event";
            case "twitter":
                return "Twitter";
            case "linkedin_profile":
                return "LinkedIn";
            case "linkedin_page":
                return "LinkedIn Page";
            default:
                return false;
        }
    }

    public function getIcon()
    {
        switch ($this->type) {
            case "fb_profile":
                return "fa fa-facebook";
            case "fb_page":
                return "fa fa-facebook";
            case "fb_group":
                return "fa fa-facebook";
            case "fb_event":
                return "fa fa-facebook";
            case "twitter":
                return "fa fa-twitter";
            case "linkedin_profile":
                return "fa fa-linkedin";
            case "linkedin_page":
                return "fa fa-linkedin";
            default:
                return false;
        }
    }

    public function getRepository()
    {
        $className = \Config::get('repos.' . $this->type);
        $namespace = "App\\Repos\\Api\\" . $className;
        $instance = new $namespace();
        return $instance;
    }

    public function hasComments()
    {
        return $this->isFacebook();
    }

    public function isFacebook()
    {
        if (in_array($this->type, ["fb_profile", "fb_page", "fb_group", "fb_event"])) {
            return true;
        } else {
            return false;
        }
    }

    public function bitly()
    {
        return $this->hasMany('App\Bitly', 'profile_id');
    }
}