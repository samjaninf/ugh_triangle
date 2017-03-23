<?php
namespace App;


use App\Repos\Api\FacebookRepository;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    private $sdk;
    private $repo;

    public function __construct()
    {
        parent::__construct();
        $this->sdk = \App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $this->repo = \App::make(FacebookRepository::class);
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'profile_id');
    }

    public function getTypeName()
    {
        return trans('messages.post_types.' . $this->getType());
    }

    public function getType()
    {
        if ($this->images != "") return "images";
        if ($this->link != "") return "link";
        return "status";
    }

    public function scopeOwn($query)
    {
        $ids = [];
        foreach (\Auth::user()->getProfiles() as $profile) {
            $ids[] = $profile->id;
        }
        return $query->whereIn('profile_id', $ids);
    }

    public function exists()
    {
        if ($this->published && $this->profile->isFacebook()) {

            $this->sdk->setDefaultAccessToken($this->profile->access_token);
            try {
                $res = $this->sdk->get('/' . $this->post_id);
            } catch (\Exception $e) {
                $this->delete();
                return false;
            }
            return true;
        }
    }

    public function getApiData($data, $type)
    {
        if ($this->published && $this->profile->isFacebook()) {
            $cacheName = 'post-' . $data . '.';
            if (!\Cache::has($cacheName . $this->id)) {
                $this->sdk->setDefaultAccessToken($this->profile->access_token);
                try {
                    $res = $this->sdk->get('/' . $this->post_id . '/' . $data);
                } catch (\Exception $e) {
                    $this->delete();
                    return $type;
                }
                $res = json_decode($res->getBody(), true);
                if (is_array($type)) {
                    $fRes = $res["data"];
                } else {
                    $fRes = count($res["data"]);
                }
                \Cache::put($cacheName . $this->id, $fRes, 30);
            }
            $res = \Cache::get($cacheName . $this->id);
            return $res;
        } else {
            return $type;
        }
    }
}