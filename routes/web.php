<?php

use App\Http\Controllers\{
    DateController,
    ExpenseController,
    HomeController,
    ProfileController
};
use App\Livewire\Note\Index;
use Illuminate\Support\Facades\{
    Auth,
    Route
};

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
    Route::get('my-expense', [ExpenseController::class, 'index'])->name('my-expense');
    Route::get('note', Index::class)->name('note');
});
