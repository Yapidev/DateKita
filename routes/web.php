<?php

use App\Http\Controllers\DateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Date\Index;
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
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::resource('date', DateController::class)->only('show');
});
