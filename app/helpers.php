<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

if(!function_exists('trim_string')) {
    function trim_string($string, $length = 15) {
        return (Str::length($string) > $length) ? Str::substr($string, 0, $length)."..."  : $string;
    }
}

if (!function_exists('validationErrorResponse')) {
	function validationErrorResponse($messages)
	{
		return Response::json(['errors' => $messages, 'message' => 'Please resolve an errors', 'data' => []], 400);
	}
}
