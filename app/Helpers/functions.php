<?php

function getAvailablePredefinedTime($profile)
{
    if (\App\PTime::where('profile_id', $profile->id)->count()) {
        $day = date("N");
        $hour = date("H");
        $minute = date("m");
        $hasPosts = 1;
        $a = null;
        $timestamp = time();
        $skip = 0;
        while ($hasPosts) {
            $a = \App\PTime::where('profile_id', $profile->id)->where(function ($query) use ($hour, $minute, $day, $profile) {
                $query->where('day', '>', $day)->orWhere(function ($query) use ($hour, $minute, $day, $profile) {
                    $query->where('day', $day)->where('hour', '>', $hour);
                    $query->orWhere('day', $day)->where('hour', $hour)->where('minute', '>', $minute);
                });
            })->orderBy('timestamp', 'ASC')->skip($skip)->first();
            if ($a == null) {
                $timestamp = strtotime("next Monday", $timestamp);
                $day = 1;
                $hour = 0;
                $minute = 0;
                $hasPosts = 1;
                $skip = 0;
            } else {
                $d = "Monday";
                switch ($a->day) {
                    case 1:
                        $d = "Monday";
                        break;
                    case 2:
                        $d = "Tuesday";
                        break;
                    case 3:
                        $d = "Wednesday";
                        break;
                    case 4:
                        $d = "Thursday";
                        break;
                    case 5:
                        $d = "Friday";
                        break;
                    case 6:
                        $d = "Saturday";
                        break;
                    case 7:
                        $d = "Sunday";
                }
                if ($timestamp == time()) {
                    $pre = "";
                    if (date("l", $timestamp) != $d) {
                        $pre = "next ";
                    }
                    $t = strtotime($pre . $d) + (3600 * $a->hour) + (60 * $a->minute);
                } else {
                    $t = $timestamp + (86400 * $a->day) + (3600 * $a->hour) + (60 * $a->minute) - 86400;
                }
                $hasPosts = \App\Post::where('ptime', $a->id)->where('time', $t)->count();
                if (!$hasPosts) {
                    $timestamp = $t;
                }
                $skip++;
            }
        }
        return [$a, $timestamp];
    }
}

function getNextPredefinedTime($profile, $last_time)
{
    if ($last_time == null) {
        $last_time = 0;
    }
    $day = date("N");
    $hour = date("H");
    $minute = date("m");
    $a = \App\PTime::where('profile_id', $profile->id)->where('day', '>', $day)->orWhere(function ($query) use ($hour, $minute, $day, $profile) {
        $query->where('day', $day)->where('hour', '>', $hour);
        $query->orWhere('day', $day)->where('hour', $hour)->where('minute', '>', $minute);
    })->orderBy('timestamp', 'ASC')->where('id', '>', $last_time)->first();
    return $a;
}


function site_option($key)
{
    $setting = \App\Setting::findOrFail($key);
    return $setting->value;
}

function tr($key)
{
    return trans('messages.' . $key);
}