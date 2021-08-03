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

/*Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/periode', function () {
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/tabel', function () {
    return view('tabel');
});

Route::get('/saldoawal', function () {
    return view('/Admin/Saldo/show');
});
Route::get('/saldoawal/create', function () {
    return view('/Admin/Saldo/create');
});
Route::get('/saldoawal/edit', function () {
    return view('/Admin/Saldo/edit');
});

Route::get('/buktiumum', function () {
    return view('/Admin/Bukti-umum/show');
});
Route::get('/buktiumum/create', function () {
    return view('/Admin/Bukti-umum/create');
});
Route::get('/buktiumum/edit', function () {
    return view('/Admin/Bukti-umum/edit');
});*/

Route::get('/penerimaan', function () {
    return view('/Admin/Penerimaan/show');
});

Route::get('/penerimaan/create', function () {
    return view('/Admin/Penerimaan/create');
});
Route::get('/penerimaan/edit', function () {
    return view('/Admin/Penerimaan/edit');
});

Route::get('/penggunaan', function () {
    return view('/Admin/Penggunaan/show');
});
Route::get('/penggunaan/create', function () {
    return view('/Admin/Penggunaan/create');
});
Route::get('/penggunaan/edit', function () {
    return view('/Admin/Penggunaan/edit');
});
Route::get('/penggunaan/show-detail', function () {
    return view('/Admin/Penggunaan/show-detail');
});


Route::get('/pengeluaran', function () {
    return view('/Admin/Pengeluaran/show');
});
Route::get('/pengeluaran/create', function () {
    return view('/Admin/Pengeluaran/create');
});
Route::get('/pengeluaran/edit', function () {
    return view('/Admin/Pengeluaran/edit');
});
Route::get('/laporan', function () {
    return view('/Admin/Laporan/show');
});


Route::get('/tabel', 'TestController@datatest');
Route::get('tabel/create', 'TestController@createdata');
Route::post('tabel/insert', 'TestController@insert');
Route::get('/tabel/delete/{id}', 'TestController@delete');
Route::get('/tabel/edit/{id}', 'TestController@editdata');
Route::post('/tabel/update/{id}', 'TestController@update');

Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
 
//CONTROLLER FIX
Route::get('/', 'LoginController@loginForm')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@login')->name('Login');
Route::get('/logout', 'LoginController@logout')->name('logout');

//PERIODE
Route::get('/periode', 'PeriodeController@dataPeriode');
Route::get('/periode/create', 'PeriodeController@addPeriode');
Route::post('/periode/insert','PeriodeController@insertPeriode');
Route::get('/periode/tutupperiode', 'PeriodeController@tutupPeriode');
Route::get('/periode/bukaperiode', 'PeriodeController@bukaPeriode');
Route::get('/periode/bukaperiode/{id}','PeriodeController@prosesBuka');
Route::get('/periode/tutupperiode/{id}','PeriodeController@prosesTutup');

//SALDO AWAL
Route::get('/saldoawal', 'SaldoAwalController@dataSaldoAwal');
Route::get('/saldoawal/create', 'SaldoAwalController@addSaldoAwal');
Route::post('/saldoawal/insert','SaldoAwalController@insertSaldoAwal');
Route::get('/saldoawal/edit/{id}','SaldoAwalController@editSaldoAwal');
Route::post('/saldoawal/update/{id}', 'SaldoAwalController@updateSaldoAwal');
Route::get('/saldoawal/statusfinal/{id}', 'SaldoAwalController@prosesFinal');

//BUKTI UMUM
Route::get('/buktiumum', 'BuktiUmumController@dataBuktiUmum');
Route::get('/buktiumum/create', 'BuktiUmumController@addBuktiUmum');
Route::post('/buktiumum/insert','BuktiUmumController@insertBuktiUmumm');
Route::get('/buktiumum/edit/{id}', 'BuktiUmumController@editBuktiUmum');
