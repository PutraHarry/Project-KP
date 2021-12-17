<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenerimaanModel;
use App\BarangModel;
use App\PeriodeModel;
use App\DetailPenerimaanModel;
use App\BarangOPDModel;
use App\ProgramModel;
use App\KegiatanModel;
use App\RekeningModel;
use App\PenggunaanModel;
use App\TestModel;
use App\AdminModel;
use App\JabatanModel;
use App\JenisBarangModel;
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
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        if (Auth::user()->jabatan->jabatan == 'PPBP') {
            $tpenerimaanObat = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'APBD Obat')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            $tpenerimaanNonObat = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'APBD Non Obat')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            $tpenerimaanHibah = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'Hibah Obat')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            $tpenerimaanNonHibah = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'Hibah Non Obat')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            $tpenerimaanNonAPBD = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'Non APBD')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
        } else {
            $tpenerimaanObat = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'APBD Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
            $tpenerimaanNonObat = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'APBD Non Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
            $tpenerimaanHibah = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'Hibah Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
            $tpenerimaanNonHibah = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'Hibah Non Obat')->where('id_periode', $dataPeriodeAktif->id)->get();
            $tpenerimaanNonAPBD = PenerimaanModel::with('program', 'kegiatan', 'rekening', 'penggunaan')->where('jenis_penerimaan', 'Non APBD')->where('id_periode', $dataPeriodeAktif->id)->get();
        }
        
        return view("Admin.Penerimaan.show", compact("tpenerimaanObat","tpenerimaanNonObat","tpenerimaanHibah","tpenerimaanNonHibah","tpenerimaanNonAPBD", "periodeAktif"));
    }

    public function addPenerimaan()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $program = ProgramModel::get();
        $rekening = RekeningModel::get();
        $idPPK = JabatanModel::where('jabatan', 'PPK')->first();
        $dataPPK = AdminModel::where('id_jabatan', $idPPK->id)->get();
        // dd($dataPPK);
        return view("Admin.Penerimaan.create", compact("periodeAktif", "program", "rekening", "dataPPK"));
    }

    public function getDataKegiatan($id)
    {
        $kegiatan = KegiatanModel::where('id_program', $id)->get();

        return response()->json($kegiatan);
    }

    public function insertPenerimaan(Request $request)
    {
        // dd($request);

        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        $validator = Validator::make($request->all(), [
            'jenis_penerimaan' => 'required',
            'tgl_input' => 'required',
            'status_penerimaan' => 'required',
            'diterima_dari' => 'required',
            'ket_penerimaan' => 'required',
            'program' => 'required',
            'kegiatan' => 'required',
            'kode_rekening' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidPenerimaan = PenerimaanModel::max('id');
        if ($lastestidPenerimaan) {
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
        } else {
            $getKodePenerimaan[2] = "0";
        }
        
        $newKodePenerimaan = $getKodePenerimaan[2] + 1;
        $penerimaanKode = $getOPD."/PNR/".$newKodePenerimaan;

        $penerimaan = new PenerimaanModel();
        $penerimaan->kode_penerimaan = $penerimaanKode;
        $penerimaan->jenis_penerimaan = $request->jenis_penerimaan;
        $penerimaan->tgl_terima = $request->tgl_input;
        $penerimaan->diterima_dari = $request->diterima_dari;
        $penerimaan->id_m_program = $request->program;
        $penerimaan->id_m_kegiatan = $request->kegiatan;
        $penerimaan->id_rekening = $request->kode_rekening;
        $penerimaan->status_penerimaan = $request->status_penerimaan;
        $penerimaan->ket_penerimaan = $request->ket_penerimaan;
        $penerimaan->id_periode = $dataPeriodeAktif->id;
        $penerimaan->id_opd = Auth::user()->opd->id;
        $penerimaan->save();
        
        
        return redirect()->route('EditPenerimaan', ['id' => $penerimaan->id]);
    }

    public function editPenerimaan($id)
    {
        $tpenerimaan = PenerimaanModel::find($id);
        $tbarang = BarangModel::get();
        $idEdit = $id;

        $program = ProgramModel::get();
        $rekening = RekeningModel::get();

        $jenisPenerimaan = ['APBD Non Obat', 'APBD Obat', 'Hibah Non Obat', 'Hibah Obat', 'Non APBD'];
        $statusPenerimaan = ['draft', 'final'];

        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $detailPenerimaan = DetailPenerimaanModel::with('barang.jenisBarang')->where('id_penerimaan',$id)->get();
        $jenisBarang = JenisBarangModel::get();

        $idPPK = JabatanModel::where('jabatan', 'PPK')->first();
        $dataPPK = AdminModel::where('id_jabatan', $idPPK->id)->get();
        return view("Admin.Penerimaan.edit", compact("periodeAktif", 'tpenerimaan', 'tbarang', 'idEdit', 'jenisPenerimaan', 'statusPenerimaan', 'detailPenerimaan', "program", "rekening", "dataPPK", "jenisBarang"));
    }

    public function updatePenerimaan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_penerimaan' => 'required',
            'kode_penerimaan' => 'required',
            'tgl_input' => 'required',
            'diterima_dari' => 'required',
            'ket_penerimaan' => 'required',
            'program' => 'required',
            'kegiatan' => 'required',
            'kode_rekening' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penerimaan = PenerimaanModel::find($id);
        $penerimaan->kode_penerimaan = $request->kode_penerimaan;
        $penerimaan->jenis_penerimaan = $request->jenis_penerimaan;
        $penerimaan->tgl_terima = $request->tgl_input;
        $penerimaan->diterima_dari = $request->diterima_dari;
        $penerimaan->id_m_program = $request->program;
        $penerimaan->id_m_kegiatan = $request->kegiatan;
        $penerimaan->id_rekening = $request->kode_rekening;
        $penerimaan->ket_penerimaan = $request->ket_penerimaan;
        $penerimaan->update();
        
        return redirect()->route('penerimaan')->with('statusInput', 'Update Success');
    }

    public function getBarang($id)
    {
        $barang = BarangModel::where('id_jenis', $id)->get();

        return response()->json($barang);
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

    public function deleteDetailPenerimaan($id)
    {
        //dd($id);
        $detailPenerimaan = DetailPenerimaanModel::find($id);
        $totaldelete = $detailPenerimaan->harga;
        $penerimaan = PenerimaanModel::where('id', $detailPenerimaan->id_penerimaan)->first();
        $penerimaan->total = $penerimaan->total - $totaldelete;
        $penerimaan->update();

        $dpenerimaan = DetailPenerimaanModel::find($id);
        $dpenerimaan->delete();
        
        return response()->json();
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

        $dpenerimaan = DetailPenerimaanModel::whereIn('id_penerimaan', [$id])->get();

        foreach ($dpenerimaan as $dp) {
            $barangOPD = BarangOPDModel::where('id_opd', Auth::user()->opd->id)->where('id_barang', $dp->id_barang)->first();
            $dataBarang = BarangModel::where('id', $dp->id_barang)->first();
            // dd($barangOPD);
            if ($barangOPD) {
                $finalPenerimaan = BarangOPDModel::find($barangOPD->id);
                $finalPenerimaan->qty = $finalPenerimaan->qty + $dp->qty;
                $finalPenerimaan->update();
            } else{
                $finalPenerimaan = new BarangOPDModel();
                $finalPenerimaan->id_opd = Auth::user()->opd->id;
                $finalPenerimaan->id_jenis = $dataBarang->id_jenis;
                $finalPenerimaan->id_barang = $dp->id_barang;
                $finalPenerimaan->qty = $finalPenerimaan->qty + $dp->qty;
                $finalPenerimaan->save();
            }
        }
        
        return redirect()->back();
    }
}