<?php
namespace App\Classes;


class DateHelper
{

    public static function convert($day)
    {
        $val = trans('messages.days.monday');
        switch ($day) {
            case 1:
                $val = tr("days.monday");
                break;
            case 2:
                $val = tr("days.tuesday");
                break;
            case 3:
                $val = tr("days.wednesday");
                break;
            case 4:
                $val = tr("days.thursday");
                break;
            case 5:
                $val = tr("days.friday");
                break;
            case 6:
                $val = tr("days.saturday");
                break;
            case 7:
                $val = tr("days.sunday");
        }
        return $val;
    }

}