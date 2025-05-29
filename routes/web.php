<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ScoreController::class, 'dashboard'])->name('dashboard');
    Route::resource('kriteria', CriteriaController::class);
    Route::resource('alternative', AlternativeController::class);
    Route::resource('score', ScoreController::class)->only(['index', 'store']);

     Route::get('/calculate-saw', [ScoreController::class, 'calculateSAW'])->name('score.calculateSAW');
     Route::get('/result/index', [ScoreController::class, 'index'])->name('score.index');
});

Route::get('/register', [RegisterController::class, 'showForm'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login-proses', [AuthController::class, 'login'])->name('loginproccess');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');