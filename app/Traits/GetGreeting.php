<?php

namespace App\Traits;

use Carbon\Carbon;

trait GetGreeting
{
    /**
     * Fungsi untuk mendapatkan ucapan selamat secara dinamis
     *
     * @return void
     */
    private function getGreeting($user)
    {
        $currentHour = Carbon::now()->hour;

        if ($currentHour < 12) {
            return 'Selamat Pagi ' . $user->name . '!';
        } elseif ($currentHour < 18) {
            return 'Selamat Siang ' . $user->name . '!';
        } elseif ($currentHour < 21) {
            return 'Selamat Sore ' . $user->name . '!';
        } else {
            return 'Selamat Malam ' . $user->name . '!';
        }
    }
}
