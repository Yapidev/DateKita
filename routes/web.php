<?php

// Import Controllers
use App\Http\Controllers\{
    DateController,
    ExpenseController,
    HomeController,
    ProfileController
};

// Import Livewire Components
use App\Livewire\Note\Index;

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
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::resource('date', DateController::class)->only('show');
    Route::get('my-expense', [ExpenseController::class, 'index'])->name('my-expense');
    Route::get('note', Index::class)->name('note');
});
