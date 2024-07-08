<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * Fungsi untuk menampilkan halaman profile
     *
     * @return void
     */
    public function index()
    {
        return view('profile');
    }
}
