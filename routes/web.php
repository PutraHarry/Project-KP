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
Route::post('/periode/prosesbukaperiode/{id}','PeriodeController@prosesBuka')->name('prosesBuka');
Route::post('/periode/prosestutupperiode/{id}','PeriodeController@prosesTutup')->name('prosesTutup');

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
Route::get('/penerimaan/edit/{id}', 'PenerimaanController@editPenerimaan')->name('EditPenerimaan');
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
Route::post('/penggunaan/approved/{idPenggunaan}', 'PenggunaanController@approvedPenggunaan')->name('approvedPenggunaan');
Route::post('/penggunaan/disetujui_ppbp/{idPenggunaan}', 'PenggunaanController@disetujui_ppbpPenggunaan')->name('disetujui_ppbpPenggunaan');
Route::post('/penggunaan/disetujui_atasanLangsung/{idPenggunaan}', 'PenggunaanController@disetujui_atasanLangsungPenggunaan')->name('disetujui_atasanLangsungPenggunaan');

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

//OPNAME
Route::get('/opname', 'OpnameController@dataOpname')->name('opname');
Route::get('/opname/create', 'OpnameController@createOpname')->name('createOpname');
Route::post('/opname/insert', 'OpnameController@insertOpname')->name('insertOpname');
Route::get('/opname/edit/{id}', 'OpnameController@editOpname')->name('editOpname');
Route::post('/opname/update/{id}', 'OpnameController@updateOpname')->name('updateOpname');
Route::post('/opname/updateDetail/{id}', 'OpnameController@insertDetailOpname')->name('updateDetailOpname');
Route::post('/opname/editDetail/{id}', 'OpnameController@editDetailOpname')->name('editDetailOpname');
Route::post('/opname/delete/{id}','OpnameController@deleteOpname')->name('deleteOpname');
Route::post('/opname/final/{id}', 'OpnameController@finalOpname')->name('finalOpname');