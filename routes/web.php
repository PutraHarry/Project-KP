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
Route::get('/periode', 'PeriodeController@dataPeriode')->name('periode')->middleware("permission:Lihat Periode");
Route::get('/periode/create', 'PeriodeController@addPeriode')->name('createPeriode')->middleware("permission:Buat Periode");
Route::post('/periode/insert','PeriodeController@insertPeriode')->name('insertPeriode')->middleware("permission:Buat Periode");
Route::get('/periode/tutupperiode', 'PeriodeController@tutupPeriode')->name('tutupPeriode')->middleware("permission:Buka Periode");
Route::get('/periode/bukaperiode', 'PeriodeController@bukaPeriode')->name('bukaPeriode')->middleware("permission:Buka Periode");
Route::post('/periode/prosesbukaperiode/{id}','PeriodeController@prosesBuka')->name('prosesBuka')->middleware("permission:Tutup Periode");
Route::post('/periode/prosestutupperiode/{id}','PeriodeController@prosesTutup')->name('prosesTutup')->middleware("permission:Tutup Periode");

//SALDO AWAL
Route::get('/saldoawal', 'SaldoAwalController@dataSaldoAwal')->name('saldoawal')->middleware("permission:Lihat Saldo Awal");
Route::get('/saldoawal/create', 'SaldoAwalController@addSaldoAwal')->name('createSaldoAwal')->middleware("permission:Buat Saldo Awal");
Route::post('/saldoawal/insert','SaldoAwalController@insertSaldoAwal')->name('insertSaldoAwal')->middleware("permission:Buat Saldo Awal");
Route::get('/saldoawal/edit/{id}','SaldoAwalController@editSaldoAwal')->name('editSaldoAwal')->middleware("permission:Edit Saldo Awal");
Route::post('/saldoawal/update/{id}', 'SaldoAwalController@updateSaldoAwal')->name('updateSaldoAwal')->middleware("permission:Edit Saldo Awal");
Route::post('/saldoawal/updateDetail/{id}', 'SaldoAwalController@insertDetailSaldoBarang')->name('updateDetailSaldoAwal')->middleware("permission:Edit Saldo Awal");
Route::post('/saldoawal/editDetail/{id}', 'SaldoAwalController@editDetailSaldoBarang')->name('editDetailSaldoAwal')->middleware("permission:Edit Saldo Awal");
Route::post('/saldoawal/delete/{id}','SaldoAwalController@deleteSaldoAwal')->name('deleteSaldoAwal')->middleware("permission:Delete Saldo Awal");
Route::post('/saldoawal/final/{id}', 'SaldoAwalController@finalSaldoAwal')->name('finalSaldoAwal')->middleware("permission:Final Saldo Awal");

//PENERIMAAN
Route::get('/penerimaan', 'PenerimaanController@dataPenerimaan')->name('penerimaan')->middleware("permission:Lihat Penerimaan");
Route::get('/penerimaan/create', 'PenerimaanController@addPenerimaan')->name('createPenerimaan')->middleware("permission:Buat Penerimaan");
Route::post('/penerimaan/insert', 'PenerimaanController@insertPenerimaan')->name('insertPenerimaan')->middleware("permission:Buat Penerimaan");
Route::get('/penerimaan/edit/{id}', 'PenerimaanController@editPenerimaan')->name('EditPenerimaan')->middleware("permission:Edit Penerimaan");
Route::post('/penerimaan/update/{id}', 'PenerimaanController@updatePenerimaan')->name('updatePenerimaan')->middleware("permission:Edit Penerimaan");
Route::post('/penerimaan/updateDetail/{id}', 'PenerimaanController@insertDetailPenerimaan')->name('updateDetailPenerimaan')->middleware("permission:Edit Penerimaan");
Route::post('/penerimaan/editDetail/{id}', 'PenerimaanController@editDetailPenerimaan')->name('editDetailPenerimaan')->middleware("permission:Edit Penerimaan");
Route::post('/penerimaan/delete/{id}','PenerimaanController@deletePenerimaan')->name('deletePenerimaan')->middleware("permission:Delete Penerimaan");
Route::post('/penerimaan/final/{id}', 'PenerimaanController@finalPenerimaan')->name('finalPenerimaan')->middleware("permission:Final Penerimaan");

//PENGGUNAAN
Route::get('/penggunaan', 'PenggunaanController@dataPenggunaan')->name('penggunaan')->middleware("permission:Lihat Penggunaan");
Route::get('/penggunaan/create', 'PenggunaanController@createPenggunaan')->name('createPenggunaan')->middleware("permission:Buat Penggunaan");
Route::post('/penggunaan/insert', 'PenggunaanController@insertPenggunaan')->name('insertPenggunaan')->middleware("permission:Buat Penggunaan");
Route::get('/penggunaan/edit/{id}', 'PenggunaanController@editPenggunaan')->name('editPenggunaan')->middleware("permission:Edit Penggunaan");
Route::post('/penggunaan/update/{id}', 'PenggunaanController@updatePenggunaan')->name('updatePenggunaan')->middleware("permission:Edit Penggunaan");
Route::get('/penggunaan/detailPenerimaan/{id}', 'PenggunaanController@getDataDetailPenerimaan')->name('getDataDetailPenerimaan')->middleware("permission:Edit Penggunaan");
Route::post('/penggunaan/delete/{id}','PenggunaanController@deletePenggunaan')->name('deletePenggunaan')->middleware("permission:Delete Penggunaan");
Route::post('/penggunaan/final/{idPenggunaan}/detail/{idPenerimaan}', 'PenggunaanController@finalPenggunaan')->name('finalPenggunaan')->middleware("permission:Final Penggunaan");
Route::post('/penggunaan/approved/{idPenggunaan}', 'PenggunaanController@approvedPenggunaan')->name('approvedPenggunaan')->middleware("permission:Approved Penggunaan");
Route::post('/penggunaan/disetujui_ppbp/{idPenggunaan}', 'PenggunaanController@disetujui_ppbpPenggunaan')->name('disetujui_ppbpPenggunaan')->middleware("permission:Disetujui PPBP Penggunaan");
Route::post('/penggunaan/disetujui_atasanLangsung/{idPenggunaan}', 'PenggunaanController@disetujui_atasanLangsungPenggunaan')->name('disetujui_atasanLangsungPenggunaan')->middleware("permission:Disetujui KASUBAG Penggunaan");

//PENGELUARAN
Route::get('/pengeluaran', 'PengeluaranController@dataPengeluaran')->name('pengeluaran')->middleware("permission:Lihat Pengeluaran");
Route::get('/pengeluaran/create', 'PengeluaranController@createPengeluaran')->name('createPengeluaran')->middleware("permission:Buat Pengeluaran");
Route::post('/pengeluaran/insert', 'PengeluaranController@insertPengeluaran')->name('insertPengeluaran')->middleware("permission:Buat Pengeluaran");
Route::get('/pengeluaran/edit/{id}', 'PengeluaranController@editPengeluaran')->name('editPengeluaran')->middleware("permission:Edit Pengeluaran");
Route::post('/pengeluaran/update/{id}', 'PengeluaranController@updatePengeluaran')->name('updatePengeluaran')->middleware("permission:Edit Pengeluaran");
Route::get('/pengeluaran/detailPenggunaan/{id}', 'PengeluaranController@getDataDetailPenggunaan')->name('getDataDetailPenggunaan')->middleware("permission:Edit Pengeluaran");
Route::post('/pengeluaran/delete/{id}','PengeluaranController@deletePengeluaran')->name('deletePengeluaran')->middleware("permission:Delete Pengeluaran");
Route::post('/pengeluaran/final/{idPengeluaran}/detail/{idPenggunaan}', 'PengeluaranController@finalPengeluaran')->name('finalPengeluaran')->middleware("permission:Final Pengeluaran");

//MASTER BARANG
Route::get('/barang', 'BarangController@dataBarang')->name('barang')->middleware("permission:Lihat Master Barang");
Route::get('/barang/create', 'BarangController@createBarang')->name('createBarang')->middleware("permission:Buat Master Barang");
Route::post('/barang/insert', 'BarangController@insertBarang')->name('insertBarang')->middleware("permission:Buat Master Barang");
Route::get('/barang/edit/{id}', 'BarangController@editBarang')->name('editBarang')->middleware("permission:Edit Master Barang");
Route::post('/barang/update/{id}', 'BarangController@updateBarang')->name('updateBarang')->middleware("permission:Edit Master Barang");
Route::post('/barang/delete/{id}', 'BarangController@deleteBarang')->name('deleteBarang')->middleware("permission:Delete Master Barang");

//TAMBAH USER
Route::get('/user', 'AdminController@dataUser')->name('user')->middleware("permission:Lihat User");
Route::get('/user/create', 'AdminController@createUser')->name('createUser')->middleware("permission:Buat User");
Route::post('/user/insert', 'AdminController@insertUser')->name('insertUser')->middleware("permission:Buat User");
Route::get('/user/edit/{id}', 'AdminController@editUser')->name('editUser')->middleware("permission:Edit User");
Route::post('/user/update/{id}', 'AdminController@updateUser')->name('updateUser')->middleware("permission:Edit User");
Route::get('/user/dataUnit/{id}', 'AdminController@getDataUnit')->name('getDataUnit')->middleware("permission:Edit User");
Route::post('/user/delete/{id}', 'AdminController@deleteUser')->name('deleteUser')->middleware("permission:Delete User");

//OPNAME
Route::get('/opname', 'OpnameController@dataOpname')->name('opname')->middleware("permission:Buat Opname");
Route::get('/opname/create', 'OpnameController@createOpname')->name('createOpname')->middleware("permission:Buat Opname");
Route::post('/opname/insert', 'OpnameController@insertOpname')->name('insertOpname')->middleware("permission:Buat Opname");
Route::get('/opname/edit/{id}', 'OpnameController@editOpname')->name('editOpname')->middleware("permission:Edit Opname");
Route::post('/opname/update/{id}', 'OpnameController@updateOpname')->name('updateOpname')->middleware("permission:Edit Opname");
Route::post('/opname/updateDetail/{id}', 'OpnameController@insertDetailOpname')->name('updateDetailOpname')->middleware("permission:Edit Opname");
Route::post('/opname/editDetail/{id}', 'OpnameController@editDetailOpname')->name('editDetailOpname')->middleware("permission:Edit Opname");
Route::post('/opname/delete/{id}','OpnameController@deleteOpname')->name('deleteOpname')->middleware("permission:Delete Opname");
Route::post('/opname/final/{id}', 'OpnameController@finalOpname')->name('finalOpname')->middleware("permission:Final Opname");

//PEMUSNAHAN
Route::get('/pemusnahan', 'PemusnahanController@dataPemusnahan')->name('pemusnahan')->middleware("permission:Lihat Pemusnahan");
Route::get('/pemusnahan/create', 'PemusnahanController@createPemusnahan')->name('createPemusnahan')->middleware("permission:Buat Pemusnahan");
Route::post('/pemusnahan/insert', 'PemusnahanController@insertPemusnahan')->name('insertPemusnahan')->middleware("permission:Buat Pemusnahan");
Route::get('/pemusnahan/edit/{id}', 'PemusnahanController@editPemusnahan')->name('editPemusnahan')->middleware("permission:Edit Pemusnahan");
Route::post('/pemusnahan/update/{id}', 'PemusnahanController@updatePemusnahan')->name('updatePemusnahan')->middleware("permission:Edit Pemusnahan");
Route::get('/pemusnahan/detailOpname/{id}', 'PemusnahanController@getDataDetailOpname')->name('getDataDetailOpname')->middleware("permission:Edit Pemusnahan");
Route::post('/pemusnahan/delete/{id}','PemusnahanController@deletePemusnahan')->name('deletePemusnahan')->middleware("permission:Delete Pemusnahan");
Route::post('/pemusnahan/final/{idPenggunaan}/detail/{idOpname}', 'PemusnahanController@finalPemusnahan')->name('finalPemusnahan')->middleware("permission:Final Pemusnahan");