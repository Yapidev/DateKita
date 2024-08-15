<?php

// Import Controllers
use App\Http\Controllers\{
    DateController,
    ExpenseController,
    HomeController,
    ProfileController
};

// Import Facades
use Illuminate\Support\Facades\{
    Auth,
    Route
};

// Auth Route Setup
Auth::routes([
    'register' => false,
    'reset'    => false,
    'confirm'  => false,
    'verify'   => false,
]);

// Public Route
Route::get('/', function () {
    return to_route('login');
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('home', App\Livewire\Home\Index::class)->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::resource('date', DateController::class)->only('show');
    Route::get('my-expense', [ExpenseController::class, 'index'])->name('my-expense');
    Route::get('note', App\Livewire\Note\Index::class)->name('note');
});
