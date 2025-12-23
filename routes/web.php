<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('pages.form_daftar');
// });

// Route::get('/manajemen/login', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manajemen/daftar-awal', 'EarlyRegisterController@index')->name('index.pendaftar')->middleware('auth');

Route::post('/manajamen/daftar-awal/simpan', 'EarlyRegisterController@store')->name('store.pendaftar')->middleware('auth');

Route::get('/manajemen/daftar-awal/edit/{id}', 'EarlyRegisterController@edit')->name('edit.pendaftar');

Route::get('/generate/reg_id/{id}', 'EarlyRegisterController@generate')->name('generateID');

Route::post('/update/reg_id/{id}', 'EarlyRegisterController@update')->name('updateID');

Route::get('/manajemen/daftar-awal/{id}', 'EarlyRegisterController@delete')->name('delete.pendaftar');

Route::get('/manajemen/login', 'EarlyRegisterController@loginForm');

Route::get('/', 'EarlyRegisterController@form')->name('form');

Route::post('pendaftar-awal/register', 'EarlyRegisterController@register')->name('siswa.pendaftar');

Route::get('/manajemen/daftar-ulang', 'ReRegisterController@index')->name('index.daftar');

Route::get('/changeStatus', 'EarlyRegisterController@change')->name('changeStatus');


Route::get('/followUp', 'EarlyRegisterController@followUp')->name('followUp');

Route::get('/export-excel', 'EarlyRegisterController@exportExcel')->name('exportExcel');

Route::post('/import-excel', 'EarlyRegisterController@importExcel')->name('importExcel');

Route::get('/searchDate', 'EarlyRegisterController@searchDate')->name('searchDate');


// CALON SISWA LOGIN
Route::get('/siswa-login', 'Auth\SiswaLoginController@showLoginForm')->name('siswa_login');
