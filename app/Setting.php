<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = "key";

    public static function add($key, $value)
    {
        $result = self::firstOrCreate([
            "key" => $key,
            "value" => e($value)
        ]);
        return $result;
    }
}
