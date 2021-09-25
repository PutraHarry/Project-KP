<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenerimaanModel;
use App\BarangModel;
use App\PeriodeModel;
use App\DetailPenerimaanModel;
use Illuminate\Support\Facades\Validator;
use DB;

class PenerimaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPenerimaan()
    {
        $tpenerimaanObat = PenerimaanModel::where('jenis_penerimaan', 'APBD Obat')->get();
        $tpenerimaanNonObat = PenerimaanModel::where('jenis_penerimaan', 'APBD Non Obat')->get();
        $tpenerimaanHibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Obat')->get();
        $tpenerimaanNonHibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Non Obat')->get();
        $tpenerimaanNonAPBD = PenerimaanModel::where('jenis_penerimaan', 'Non APBD')->get();
        
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Penerimaan.show", compact("tpenerimaanObat","tpenerimaanNonObat","tpenerimaanHibah","tpenerimaanNonHibah","tpenerimaanNonAPBD", "periodeAktif"));
    }

    public function addPenerimaan()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Penerimaan.create", compact("periodeAktif"));
    }

    public function insertPenerimaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_penerimaan' => 'required',
            'namaPenerimaan' => 'required',
            'tgl_input' => 'required',
            'status_penerimaan' => 'required',
            'pengirim' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penerimaan = new PenerimaanModel();
        $penerimaan->kode_penerimaan = $request->namaPenerimaan;
        $penerimaan->jenis_penerimaan = $request->jenis_penerimaan;
        $penerimaan->tgl_terima = $request->tgl_input;
        $penerimaan->pengirim = $request->pengirim;
        $penerimaan->status_penerimaan = $request->status_penerimaan;
        $penerimaan->save();
        
        
        return redirect()->route('penerimaanEdit', ['id' => $penerimaan->id]);
    }

    public function editPenerimaan($id)
    {
        $tpenerimaan = PenerimaanModel::find($id);
        $tbarang = BarangModel::get();
        $idEdit = $id;

        $jenisPenerimaan = ['APBD Non Obat', 'APBD Obat', 'Hibah Non Obat', 'Hibah Obat', 'Non APBD'];
        $statusPenerimaan = ['draft', 'final'];
        //dd($jenisPenerimaan);
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $detailPenerimaan = DetailPenerimaanModel::with('barang')->where('id_penerimaan',$id)->get();

        return view("Admin.Penerimaan.edit", compact("periodeAktif", 'tpenerimaan', 'tbarang', 'idEdit', 'jenisPenerimaan', 'statusPenerimaan', 'detailPenerimaan'));
    }

    public function updatePenerimaan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_penerimaan' => 'required',
            'namaPenerimaan' => 'required',
            'tgl_input' => 'required',
            'pengirim' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penerimaan = PenerimaanModel::find($id);
        $penerimaan->kode_penerimaan = $request->namaPenerimaan;
        $penerimaan->jenis_penerimaan = $request->jenis_penerimaan;
        $penerimaan->tgl_terima = $request->tgl_input;
        $penerimaan->pengirim = $request->pengirim;
        $penerimaan->update();
        
        return redirect()->route('penerimaan')->with('statusInput', 'Update Success');
    }

    public function insertDetailPenerimaan($id, Request $request)
    {
        $dpenerimaan = new DetailPenerimaanModel();
        $dpenerimaan->id_penerimaan = $id;
        $dpenerimaan->id_barang = $request->id_barang;
        $dpenerimaan->qty = $request->qty;
        $dpenerimaan->harga = $request->total;
        $dpenerimaan->keterangan = $request->keterangan;
        $dpenerimaan->save();
      
        $mpenerimaan = PenerimaanModel::find($id);
        $mpenerimaan->total = $mpenerimaan->total + $request->total;
        $mpenerimaan->update();
      
        return redirect()->back();
    }

    public function editDetailPenerimaan($id, Request $request)
    {
        //dd($id);
        $dpenerimaan = DetailPenerimaanModel::find($id);

        $newTotal = $request->total;
        $oldTotal = $dpenerimaan->total;
        $gapTotal = $newTotal-$oldTotal;


        $dpenerimaan->id_barang = $request->id_barang;
        $dpenerimaan->qty = $request->qty;
        $dpenerimaan->harga = $request->total;
        $dpenerimaan->keterangan = $request->keterangan;
        $dpenerimaan->update();

        $mpenerimaan = PenerimaanModel::find($dpenerimaan->id_saldo);
        $mpenerimaan->total = $mpenerimaan->total + $gapTotal;
        $mpenerimaan->update();
        return redirect()->back();
    }
}
