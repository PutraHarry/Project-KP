<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenerimaanModel;
use App\BarangModel;
use App\PeriodeModel;
use App\DetailPenerimaanModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class PenerimaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPenerimaan()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpenerimaanObat = PenerimaanModel::where('jenis_penerimaan', 'APBD Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
        $tpenerimaanNonObat = PenerimaanModel::where('jenis_penerimaan', 'APBD Non Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
        $tpenerimaanHibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
        $tpenerimaanNonHibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Non Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
        $tpenerimaanNonAPBD = PenerimaanModel::where('jenis_penerimaan', 'Non APBD')->where('id_periode', $dataPeriodeAktif->id)->get();

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
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', ['open'])->first();

        $validator = Validator::make($request->all(), [
            'jenis_penerimaan' => 'required',
            'tgl_input' => 'required',
            'status_penerimaan' => 'required',
            'pengirim' => 'required',
            'ket_penerimaan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidPenerimaan = PenerimaanModel::max('id');
        $getLastestPenerimaan = PenerimaanModel::find($lastestidPenerimaan);
        $lastestKodePenerimaan = $getLastestPenerimaan->kode_penerimaan;
        if ($lastestKodePenerimaan) {
            $getKodePenerimaan = explode("/", $lastestKodePenerimaan);
            for ($i=0; $i < count($getKodePenerimaan); $i++) { 
                echo $getKodePenerimaan[$i];
            }
        }else {
            $getKodePenerimaan[2] = "0";
        }
        $newKodePenerimaan = $getKodePenerimaan[2] + 1;
        $penerimaanKode = $getOPD."/PNR/".$newKodePenerimaan;

        $penerimaan = new PenerimaanModel();
        $penerimaan->kode_penerimaan = $penerimaanKode;
        $penerimaan->jenis_penerimaan = $request->jenis_penerimaan;
        $penerimaan->tgl_terima = $request->tgl_input;
        $penerimaan->pengirim = $request->pengirim;
        $penerimaan->status_penerimaan = $request->status_penerimaan;
        $penerimaan->ket_penerimaan = $request->ket_penerimaan;
        $penerimaan->id_periode = $dataPeriodeAktif->id;
        $penerimaan->save();
        
        
        return redirect()->route('EditPenerimaan', ['id' => $penerimaan->id]);
    }

    public function editPenerimaan($id)
    {
        $tpenerimaan = PenerimaanModel::find($id);
        $tbarang = BarangModel::get();
        $idEdit = $id;

        $jenisPenerimaan = ['APBD Non Obat', 'APBD Obat', 'Hibah Non Obat', 'Hibah Obat', 'Non APBD'];
        $statusPenerimaan = ['draft', 'final'];
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
            'kode_penerimaan' => 'required',
            'tgl_input' => 'required',
            'pengirim' => 'required',
            'ket_penerimaan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penerimaan = PenerimaanModel::find($id);
        $penerimaan->kode_penerimaan = $request->kode_penerimaan;
        $penerimaan->jenis_penerimaan = $request->jenis_penerimaan;
        $penerimaan->tgl_terima = $request->tgl_input;
        $penerimaan->pengirim = $request->pengirim;
        $penerimaan->ket_penerimaan = $request->ket_penerimaan;
        $penerimaan->update();
        
        return redirect()->route('penerimaan')->with('statusInput', 'Update Success');
    }

    public function insertDetailPenerimaan($id, Request $request)
    {
        //dd($request);
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

    public function deletePenerimaan($id)
    {
        $detailPenerimaan = DetailPenerimaanModel::where('id_penerimaan', $id)->delete();

        $penerimaan = PenerimaanModel::find($id);
        $penerimaan->delete();
        
        return redirect('/penerimaan')->with('statusInput', 'Delete Success');
    }

    public function finalPenerimaan($id, Request $request)
    {
        $penerimaan = PenerimaanModel::find($id);
        $penerimaan->kode_penerimaan = $request->kodePenerimaan;
        $penerimaan->jenis_penerimaan = $request->jenisPenerimaan;
        $penerimaan->tgl_terima = $request->tglPenerimaan;
        $penerimaan->ket_penerimaan = $request->ketPenerimaan;
        $penerimaan->status_penerimaan = 'final';
        $penerimaan->update();
        
        return redirect('/penerimaan')->with('statusInput', 'Status Final Berhasil');
    }
}
