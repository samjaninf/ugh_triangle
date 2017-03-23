<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class PTime extends Model
{
    public $timestamps = false;
    protected $table = 'publish_times';
    protected $guarded = [];

    public function toTimestamp()
    {
        $d = "Monday";
        switch ($this->day) {
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
        $timestamp = strtotime('next ' . $d) + (3600 * $this->hour) + (60 * $this->minute);
        return $timestamp;
    }
}