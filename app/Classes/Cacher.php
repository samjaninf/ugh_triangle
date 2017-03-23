<?php
namespace App\Classes;


class Cacher
{

    public static function cache($name, $code, $minutes = 15)
    {
        if (!\Cache::has($name)) {
            \Cache::put($name, $code(), $minutes);
        }
        return \Cache::get($name);
    }

}