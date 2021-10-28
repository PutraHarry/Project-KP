<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PenggunaanModel;
use App\PeriodeModel;
use App\PenerimaanModel;
use App\DetailPenerimaanModel;
use App\DetailPenggunaanModel;


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
            'kode_penggunaan' => 'required',
            'tgl_input' => 'required',
            'id_penerimaan' => 'required',
            'status_saldo' => 'required',
            'ket_penggunaan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penggunaan = new PenggunaanModel();
        $penggunaan->kode_penggunaan = $request->kode_penggunaan;
        $penggunaan->tgl_penggunaan = $request->tgl_input;
        $penggunaan->id_penerimaan = $request->id_penerimaan;
        $penggunaan->gudang_asal = Auth::user()->unit->opd->nama_opd;
        $penggunaan->gudang_tujuan = Auth::user()->unit->unit;
        $penggunaan->status_penggunaan = $request->status_saldo;
        $penggunaan->ket_penggunaan = $request->ket_penggunaan;
        //dd($penggunaan);
        $penggunaan->save();

        /*$penerimaan = DetailPenerimaanModel::whereIn('id_penerimaan', [$penggunaan->id_penerimaan])->get();
        //dd($penerimaan);

        foreach ($penerimaan as $dataPenerimaan) {
            $detailPenggunaan = new DetailPenggunaanModel();
            $detailPenggunaan->id_penggunaan = $penggunaan->id;
            $detailPenggunaan->id_barang = $dataPenerimaan->id_barang;
            $detailPenggunaan->qty = $dataPenerimaan->qty;
            $detailPenggunaan->harga = $dataPenerimaan->harga;
            $detailPenggunaan->keterangan = $dataPenerimaan->keterangan;
            //dd($detailPenggunaan);
            $detailPenggunaan->save();
        }*/

        
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
        //$barangPenggunaan = DetailPenggunaanModel::with('barang')->where('id_penggunaan', $id)->get();
        $idEdit = $id;

        return view("Admin.Penggunaan.edit", compact('periodeAktif', 'tpenggunaan', 'idEdit', 'tpenerimaan'));
    }

    public function updatePenggunaan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_penggunaan' => 'required',
            'tgl_input' => 'required',
            'id_penerimaan' => 'required',
            'ket_penggunaan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->kode_penggunaan = $request->kode_penggunaan;
        $penggunaan->tgl_penggunaan = $request->tgl_input;
        $penggunaan->id_penerimaan = $request->id_penerimaan;
        $penggunaan->ket_penggunaan = $request->ket_penggunaan;
        //dd($penggunaan);
        $penggunaan->update();

        return redirect()->route('penggunaan')->with('statusInput', 'Update Success');
    }

    public function getDataDetailPenerimaan($id)
    {
        $detailPenerimaan = DetailPenerimaanModel::with('barang')->where('id_penerimaan',$id)->get();

        return response()->json($detailPenerimaan);
    }

    public function finalPenggunaan($idPenggunaan, $idPenerimaan, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tglPenggunaan' => 'required',
            'kodePenerimaan' => 'required',
            'kodePenggunaan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penerimaanData = PenerimaanModel::find($idPenerimaan);
        //dd($Penerimaandata);

        $penggunaan = PenggunaanModel::find($idPenggunaan);
        $penggunaan->kode_penggunaan = $request->kodePenggunaan;
        $penggunaan->tgl_penggunaan = $request->tglPenggunaan;
        $penggunaan->id_penerimaan = $idPenerimaan;
        $penggunaan->status_penggunaan = 'final';
        $penggunaan->total = $penerimaanData->total;
        $penggunaan->ket_penggunaan = $request->ketPenggunaan;
        $penggunaan->update();

        $penerimaan = DetailPenerimaanModel::whereIn('id_penerimaan', [$idPenerimaan])->get();
        //dd($penerimaan);

        foreach ($penerimaan as $dataPenerimaan) {
            $detailPenggunaan = new DetailPenggunaanModel();
            $detailPenggunaan->id_penggunaan = $idPenggunaan;
            $detailPenggunaan->id_barang = $dataPenerimaan->id_barang;
            $detailPenggunaan->qty = $dataPenerimaan->qty;
            $detailPenggunaan->harga = $dataPenerimaan->harga;
            $detailPenggunaan->keterangan = $dataPenerimaan->keterangan;
            //dd($detailPenggunaan);
            $detailPenggunaan->save();
        }

        return redirect()->route('penggunaan')->with('statusInput', 'Status Final Success');
    }
}
