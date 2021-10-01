<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PenggunaanModel;
use App\PeriodeModel;
use App\PenerimaanModel;


class PenggunaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPenggunaan()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpenggunaan = PenggunaanModel::get();
        return view("Admin.Penggunaan.show", compact('periodeAktif', 'tpenggunaan'));
    }

    public function createPenggunaan()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpenerimaan = PenerimaanModel::get();

        return view("Admin.Penggunaan.create", compact('periodeAktif', 'tpenerimaan'));
    }

    public function insertPenggunaan(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'id_penerimaan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penggunaan = new PenggunaanModel();
        $penggunaan->tgl_penggunaan = $request->tgl_input;
        $penggunaan->id_BU = $request->id_penerimaan;
        $penggunaan->gudang_asal = Auth::user()->unit->opd->nama_opd;
        $penggunaan->gudang_tujuan = Auth::user()->unit->unit;
        $penggunaan->status_penggunaan = "draft";
        //dd($penggunaan);
        $penggunaan->save();
        
        return redirect()->route('editPenggunaan', ['id' => $penggunaan->id]);
    }

    public function editPenggunaan($id)
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpenggunaan = PenggunaanModel::find($id);
        $tpenerimaan = PenerimaanModel::get();
        $idEdit = $id;

        return view("Admin.Penggunaan.edit", compact('periodeAktif', 'tpenggunaan', 'idEdit', 'tpenerimaan'));
    }
}
