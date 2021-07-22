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

//CONTROLLER COBA
Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/periode', function () {
    return view('/Admin/Periode/show');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tabel', function () {
    return view('tabel');
});

Route::get('/tabel', 'TestController@datatest');
Route::get('tabel/create', 'TestController@createdata');
Route::post('tabel/insert', 'TestController@insert');
Route::get('/tabel/delete/{id}', 'TestController@delete');
Route::get('/tabel/edit/{id}', 'TestController@editdata');
Route::post('/tabel/update/{id}', 'TestController@update');


//CONTROLLER FIX
Route::get('/login', 'LoginController@loginForm')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@login')->name('Login');
Route::get('/logout', 'LoginController@logout')->name('logout');

