<?php
use Illuminate\Support\Str;

if(!function_exists('trim_string')) {
    function trim_string($string, $length = 15) {
        return (Str::length($string) > $length) ? Str::substr($string, 0, $length)."..."  : $string;
    }
}
