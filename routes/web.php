<?php

use App\Http\Controllers\DateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});

Auth::routes([
    'register' => false,
    'reset'    => false,
    'confirm'  => false,
    'verify'   => false,
]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('date', DateController::class);
});
