<?php

namespace App\Helpers;

use Carbon\Carbon;

class Time
{
    public static function greeting()
    {
        date_default_timezone_set('Asia/Jakarta');
        $hour = Carbon::now()->format('H');
        if ($hour >= 5 && $hour < 12) {
            return 'Good morning';
        } elseif ($hour >= 12 && $hour < 15) {
            return 'Good afternoon';
        } elseif ($hour >= 15 && $hour < 18) {
            return 'Good evening';
        } else {
            return 'Good night';
        }
    }
}
