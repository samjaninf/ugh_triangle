<?php
namespace App\Classes;


class Spintax
{

    /**
     * Transforms a spintax to text
     * @param $string
     * @return string
     */
    public static function transform($string)
    {
        preg_match('#{(.+?)}#is', $string, $m);
        if (empty($m)) return $string;

        $t = $m[1];

        if (strpos($t, '{') !== false) {
            $t = substr($t, strrpos($t, '{') + 1);
        }

        $parts = explode("|", $t);
        $string = preg_replace("+{" . preg_quote($t) . "}+is", $parts[array_rand($parts)], $string, 1);

        return self::transform($string);
    }

}