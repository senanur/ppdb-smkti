<?php

use App\Http\Controllers\Auth\SiswaLoginController;
use App\Http\Controllers\EarlyRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReRegisterController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('pages.form_daftar');
// });

// Route::get('/manajemen/login', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/manajemen/daftar-awal', [EarlyRegisterController::class, 'index'])->name('index.pendaftar')->middleware('auth');

Route::post('/manajamen/daftar-awal/simpan', [EarlyRegisterController::class, 'store'])->name('store.pendaftar')->middleware('auth');

Route::get('/manajemen/daftar-awal/edit/{id}', [EarlyRegisterController::class, 'edit'])->name('edit.pendaftar');

Route::get('/generate/reg_id/{id}', [EarlyRegisterController::class, 'generate'])->name('generateID');

Route::post('/update/reg_id/{id}', [EarlyRegisterController::class, 'update'])->name('updateID');

Route::get('/manajemen/daftar-awal/{id}', [EarlyRegisterController::class, 'delete'])->name('delete.pendaftar');

Route::get('/manajemen/login', [EarlyRegisterController::class, 'loginForm']);

Route::get('/', [EarlyRegisterController::class, 'form'])->name('form');

Route::post('pendaftar-awal/register', [EarlyRegisterController::class, 'register'])->name('siswa.pendaftar');

Route::get('/manajemen/daftar-ulang', [ReRegisterController::class, 'index'])->name('index.daftar');

Route::get('/changeStatus', [EarlyRegisterController::class, 'change'])->name('changeStatus');


Route::get('/followUp', [EarlyRegisterController::class, 'followUp'])->name('followUp');

Route::get('/export-excel', [EarlyRegisterController::class, 'exportExcel'])->name('exportExcel');

Route::post('/import-excel', [EarlyRegisterController::class, 'importExcel'])->name('importExcel');

Route::get('/searchDate', [EarlyRegisterController::class, 'searchDate'])->name('searchDate');


// CALON SISWA LOGIN
Route::get('/siswa-login', [SiswaLoginController::class, 'showLoginForm'])->name('siswa_login');
