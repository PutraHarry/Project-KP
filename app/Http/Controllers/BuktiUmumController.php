<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuktiUmumModel;
use App\PeriodeModel;
use Illuminate\Support\Facades\Validator;
use DB;

class BuktiUmumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataBuktiUmum()
    {
        $tbukti = BuktiUmumModel::get();

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Bukti-Umum.show", compact("tbukti", "periodeAktif"));
    }

    public function addBuktiUmum()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Bukti-Umum.create", "periodeAktif");
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

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Bukti-Umum.edit", compact("buktiumum", "periodeAktif"));
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
