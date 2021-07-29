<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
});

/*Route::get('/periode', function () {
    return view('/Admin/Periode/show');
});
Route::get('/periode/create', function () {
    return view('/Admin/Periode/create');
});

Route::get('/periode/tutup', function () {
    return view('/Admin/Periode/tutupperiode');
});
Route::get('/periode/buka', function () {
    return view('/Admin/Periode/bukaperiode');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tabel', function () {
    return view('tabel');
});*/

Route::get('/saldoawal', function () {
    return view('/Admin/Saldo/show');
});
Route::get('/saldoawal/create', function () {
    return view('/Admin/Saldo/create');
});


Route::get('/buktiumum', function () {
    return view('/Admin/Bukti-umum/show');
});
Route::get('/buktiumum/create', function () {
    return view('/Admin/Bukti-umum/create');
});
Route::get('/buktiumum/edit', function () {
    return view('/Admin/Bukti-umum/edit');
});



Route::get('/tabel', 'TestController@datatest');
Route::get('tabel/create', 'TestController@createdata');
Route::post('tabel/insert', 'TestController@insert');
Route::get('/tabel/delete/{id}', 'TestController@delete');
Route::get('/tabel/edit/{id}', 'TestController@editdata');
Route::post('/tabel/update/{id}', 'TestController@update');

Route::get('/dashboard','AdminController@dashboard')->name('dashboard');

//PERIODE
Route::get('/periode', 'PeriodeController@dataPeriode');
Route::get('/periode/create', 'PeriodeController@addPeriode');
Route::post('/periode/insert','PeriodeController@insert');
Route::get('/periode/tutupperiode', 'PeriodeController@tutupPeriode');
Route::get('/periode/bukaperiode', 'PeriodeController@bukaPeriode');


//CONTROLLER FIX
Route::get('/login', 'LoginController@loginForm')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@login')->name('Login');
Route::get('/logout', 'LoginController@logout')->name('logout');
