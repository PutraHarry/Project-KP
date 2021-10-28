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
});

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
});*/

Route::get('/tambah-user', function () {
    return view('/Admin/Tambah-User/show');
});
Route::get('/tambah-user/create', function () {
    return view('/Admin/Tambah-User/create');
});
Route::get('/tambah-user/edit', function () {
    return view('/Admin/Tambah-User/edit');
});

/*Route::get('/master-barang', function () {
    return view('/Admin/Master-Barang/show');
});
Route::get('/master-barang/create', function () {
    return view('/Admin/Master-Barang/create');
});*/


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
Route::get('/periode', 'PeriodeController@dataPeriode')->name('periode');
Route::get('/periode/create', 'PeriodeController@addPeriode')->name('createPeriode');
Route::post('/periode/insert','PeriodeController@insertPeriode')->name('insertPeriode');
Route::get('/periode/tutupperiode', 'PeriodeController@tutupPeriode')->name('tutupPeriode');
Route::get('/periode/bukaperiode', 'PeriodeController@bukaPeriode')->name('bukaPeriode');
Route::post('/periode/bukaperiode/{id}','PeriodeController@prosesBuka')->name('prosesBuka');
Route::post('/periode/tutupperiode/{id}','PeriodeController@prosesTutup')->name('prosesTutup');

//SALDO AWAL
Route::get('/saldoawal', 'SaldoAwalController@dataSaldoAwal')->name('saldoawal');
Route::get('/saldoawal/create', 'SaldoAwalController@addSaldoAwal')->name('createSaldoAwal');
Route::post('/saldoawal/insert','SaldoAwalController@insertSaldoAwal')->name('insertSaldoAwal');
Route::get('/saldoawal/edit/{id}','SaldoAwalController@editSaldoAwal')->name('editSaldoAwal');
Route::post('/saldoawal/update/{id}', 'SaldoAwalController@updateSaldoAwal')->name('updateSaldoAwal');
Route::post('/saldoawal/updateDetail/{id}', 'SaldoAwalController@insertDetailSaldoBarang')->name('updateDetailSaldoAwal');
Route::post('/saldoawal/editDetail/{id}', 'SaldoAwalController@editDetailSaldoBarang')->name('editDetailSaldoAwal');
Route::post('/saldoawal/delete/{id}','SaldoAwalController@deleteSaldoAwal')->name('deleteSaldoAwal');
Route::post('/saldoawal/final/{id}', 'SaldoAwalController@finalSaldoAwal')->name('finalSaldoAwal');

//PENERIMAAN
Route::get('/penerimaan', 'PenerimaanController@dataPenerimaan')->name('penerimaan');
Route::get('/penerimaan/create', 'PenerimaanController@addPenerimaan')->name('createPenerimaan');
Route::post('/penerimaan/insert', 'PenerimaanController@insertPenerimaan')->name('insertPenerimaan');
Route::get('/penerimaan/edit/{id}', 'PenerimaanController@editPenerimaan')->name('penerimaanEdit');
Route::post('/penerimaan/update/{id}', 'PenerimaanController@updatePenerimaan')->name('updatePenerimaan');
Route::post('/penerimaan/updateDetail/{id}', 'PenerimaanController@insertDetailPenerimaan')->name('updateDetailPenerimaan');
Route::post('/penerimaan/editDetail/{id}', 'PenerimaanController@editDetailPenerimaan')->name('editDetailPenerimaan');
Route::post('/penerimaan/delete/{id}','PenerimaanController@deletePenerimaan')->name('deletePenerimaan');
Route::post('/penerimaan/final/{id}', 'PenerimaanController@finalPenerimaan')->name('finalPenerimaan');

//PENGGUNAAN
Route::get('/penggunaan', 'PenggunaanController@dataPenggunaan')->name('penggunaan');
Route::get('/penggunaan/create', 'PenggunaanController@createPenggunaan')->name('createPenggunaan');
Route::post('/penggunaan/insert', 'PenggunaanController@insertPenggunaan')->name('insertPenggunaan');
Route::get('/penggunaan/edit/{id}', 'PenggunaanController@editPenggunaan')->name('editPenggunaan');
Route::post('/penggunaan/update/{id}', 'PenggunaanController@updatePenggunaan')->name('updatePenggunaan');
Route::get('/penggunaan/detailPenerimaan/{id}', 'PenggunaanController@getDataDetailPenerimaan')->name('getDataDetailPenerimaan');
Route::post('/penggunaan/delete/{id}','PenggunaanController@deletePenggunaan')->name('deletePenggunaan');
Route::post('/penggunaan/final/{idPenggunaan}/detail/{idPenerimaan}', 'PenggunaanController@finalPenggunaan')->name('finalPenggunaan');

//PENGELUARAN
Route::get('/pengeluaran', 'PengeluaranController@dataPengeluaran')->name('pengeluaran');
Route::get('/pengeluaran/create', 'PengeluaranController@createPengeluaran')->name('createPengeluaran');
Route::post('/pengeluaran/insert', 'PengeluaranController@insertPengeluaran')->name('insertPengeluaran');
Route::get('/pengeluaran/edit/{id}', 'PengeluaranController@editPengeluaran')->name('editPengeluaran');
Route::post('/pengeluaran/update/{id}', 'PengeluaranController@updatePengeluaran')->name('updatePengeluaran');
Route::get('/pengeluaran/detailPenggunaan/{id}', 'PengeluaranController@getDataDetailPenggunaan')->name('getDataDetailPenggunaan');
Route::post('/pengeluaran/delete/{id}','PengeluaranController@deletePengeluaran')->name('deletePengeluaran');
Route::post('/pengeluaran/final/{idPengeluaran}/detail/{idPenggunaan}', 'PengeluaranController@finalPengeluaran')->name('finalPengeluaran');

//MASTER BARANG
Route::get('/barang', 'BarangController@dataBarang')->name('barang');
Route::get('/barang/create', 'BarangController@createBarang')->name('createBarang');
Route::post('/barang/insert', 'BarangController@insertBarang')->name('insertBarang');
Route::get('/barang/edit/{id}', 'BarangController@editBarang')->name('editBarang');
Route::post('/barang/update/{id}', 'BarangController@updateBarang')->name('updateBarang');
Route::post('/barang/delete/{id}', 'BarangController@deleteBarang')->name('deleteBarang');

//TAMBAH USER
Route::get('/user', 'AdminController@dataUser')->name('user');
Route::get('/user/create', 'AdminController@createUser')->name('createUser');
Route::post('/user/insert', 'AdminController@insertUser')->name('insertUser');
Route::get('/user/edit/{id}', 'AdminController@editUser')->name('editUser');
Route::post('/user/update/{id}', 'AdminController@updateUser')->name('updateUser');
Route::get('/user/dataUnit/{id}', 'AdminController@getDataUnit')->name('getDataUnit');
Route::post('/user/delete/{id}', 'AdminController@deleteUser')->name('deleteUser');

//BUKTI UMUM
//Rsoute::get('/buktiumum', 'BuktiUmumController@dataBuktiUmum');
//Route::get('/buktiumum/create', 'BuktiUmumController@addBuktiUmum');
//Route::post('/buktiumum/insert','BuktiUmumController@insertBuktiUmum');
//Route::get('/buktiumum/edit/{id}', 'BuktiUmumController@editBuktiUmum');
