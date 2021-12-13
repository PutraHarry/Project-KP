<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\TestModel;
use Illuminate\Support\Facades\Validator;
use App\BarangModel;
use App\BarangOPDModel;
use App\BarangUnitModel;
use App\DetailSaldoAwalModel;
use App\DetailPenerimaanModel;
use App\DetailPengeluaranModel;
use App\DetailOpnameModel;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function datatest(){
        $data = [

            'title' => 'Test Data'
        ];

        $testdata = TestModel::get();

        $Total = TestModel::orderby('Id')->get();
        return view('tabel', compact('Total','testdata'), $data);
    }

    public function createdata()
    {
        $data = [
            'title' => 'Tambah Data Test'
        ];
        return view('create', $data);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'keterangan' => 'required',
           
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $testdata = new TestModel();
        $testdata->nama = $request->nama;
        $testdata->keterangan = $request->keterangan;
       
        $testdata->save();
        return redirect('/tabel')->with('statusInput', 'Input Success');
    }

    public function editdata($id)
    {
        $data = [
            'title' => 'Edit Data Test'
        ];
        $testdata = TestModel::find($id);
        return view("edit", compact('testdata'), $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'keterangan' => 'required',
            
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $testdata = TestModel::find($id);
        $testdata->nama = $request->nama;
        $testdata->keterangan = $request->keterangan;

        $testdata->update();
        return redirect('/tabel')->with('statusInput', 'Update Success');
    }

    public function delete($id){
        $testdata = TestModel::find($id);
        $testdata->delete();
        return redirect('/tabel')->with('statusInput', 'Delete Success');
    }

    public function testTabel()
    {
        $barang = BarangModel::with('barangOPD', 'detailSaldoAwal', 'detailPenerimaan', 'detailPengeluaran', 'detailOpname')->get();
        //dd($barang);

        return view("tabel");
    }

    public function tabel()
    {
        $coba = BarangModel::get();
        $barangUnit = BarangUnitModel::with('barang')->get();
        $detailSaldoAwal = DetailSaldoAwalModel::with('barang')->get();
        $detailPenerimaan = DetailPenerimaanModel::with('barang')->get();
        $detailPengeluaran = DetailPengeluaranModel::with('barang')->get();

        $dataBarang = DetailSaldoAwalModel::where('id_barang', 1)->get();
        $totalHarga = $dataBarang->sum('harga');
        // dd($totalHarga);

        return view("coba-tabel", compact('coba', 'barangUnit', 'detailSaldoAwal', 'detailPenerimaan', 'detailPengeluaran'));
    }

    public function getDataSaldoAwal($id)
    {
        $dataBarang = DetailSaldoAwalModel::where('id_barang', $id)->get();
        $jumlahBarang = $dataBarang->sum('qty');
        $totalHarga = $dataBarang->sum('harga');
        return response()->json(['jumlahBarang' => $jumlahBarang, 'dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function getDataPenerimaan($id)
    {
        $dataBarang = DetailPenerimaanModel::where('id_barang', $id)->get();
        $jumlahBarang = $dataBarang->sum('qty');
        $totalHarga = $dataBarang->sum('harga');
        return response()->json(['jumlahBarang' => $jumlahBarang, 'dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function getDataPengeluaran($id)
    {
        $dataBarang = DetailPengeluaranModel::where('id_barang', $id)->get();
        $jumlahBarang = $dataBarang->sum('qty');
        $totalHarga = $dataBarang->sum('harga');
        return response()->json(['jumlahBarang' => $jumlahBarang, 'dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function getDataBarangOPD($id)
    {
        $barang = BarangModel::find($id);
        $dataBarang = BarangOPDModel::where('id_barang', $id)->first();
        $totalHarga = $dataBarang->qty * $barang->harga_m_barang;
        return response()->json(['dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function testDataTabel()
    {
        $barang = BarangModel::get();

        $test = view('coba-tabel', ['barang' => $barang])->render();

        return response()->json($test);
    }

    public function test()
    {
        return view("Admin.Laporan.Barang.L_opname");
    }
}