<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\TestModel;
use Illuminate\Support\Facades\Validator;
use App\BarangModel;

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
        return view("tabel");
    }

    public function testDataTabel()
    {
        $test = TestModel::get();

        $barang = BarangModel::get();

        return response()->json(['var1' => $test, 'var2' => $barang]);
    }

    public function test()
    {
        return view("Admin.Laporan.Barang.L_opname");
    }
}