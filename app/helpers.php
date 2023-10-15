<?php

use App\Models\User;
use Carbon\Carbon;

if (!function_exists('accessToken')) {

    function accessToken(User $user)
    {
        if ($user->tokens->count() > 0) {

            $user->tokens->each->delete();
        }

        $token = $user->createToken($user->name)->accessToken;

        return $token;
    }
}

if (!function_exists('format_date')) {

    function format_date(Carbon $date)
    {
        return date('d M, Y', strtotime($date));
    }
}


