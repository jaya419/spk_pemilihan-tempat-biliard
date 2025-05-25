<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;



Route::middleware('auth')->group(function () {
Route::get('/', [SawController::class, 'beranda'])->name('beranda.index');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');


Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');


Route::get('/hasil', [SawController::class, 'hitungSaw'])->name('smart.hasil');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
Route::get('/hasil', [SawController::class, 'hitungSaw'])->name('hasil.index');

Route::resource('karyawan', KaryawanController::class);
Route::resource('kriteria', KriteriaController::class);
});

Route::get('/register', [RegisterController::class, 'showForm'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login-proses', [AuthController::class, 'login'])->name('loginproccess');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');