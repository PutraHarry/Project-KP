<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuktiUmumModel;
use Illuminate\Support\Facades\Validator;
use DB;

class BuktiUmumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataBuktiUmum()
    {
        $tbukti = BuktiUmumModel::get();

        return view("Admin.Bukti-Umum.show", compact("tbukti"));
    }

    public function addBuktiUmum()
    {
        return view("Admin.Bukti-Umum.create");
    }

    public function insertBuktiUmum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_BU' => 'required',
            'tgl_BU' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $buktiumum = new BuktiUmumModel();
        $buktiumum->no_BU = $request->no_BU;
        $buktiumum->tgl_BU = $request->tgl_BU;
        $buktiumum->save();
        return redirect('/saldoawal')->with('statusInput', 'Input Success');
    }
    
    public function editBuktiUmum($id)
    {
        $buktiumum = BuktiUmumModel::find($id);
        return view("Admin.Bukti-Umum.edit", compact("buktiumum"));
    }

    public function updateBuktiUmum($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        
        return redirect('/buktiumum')->with('statusInput', 'Update Success');
    }
}
