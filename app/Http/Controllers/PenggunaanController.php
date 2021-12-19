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
use App\BarangOPDModel;
use App\barangUnitModel;


class PenggunaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPenggunaan()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        if (Auth::user()->jabatan->jabatan == 'PPBPB') {
            $tpenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
            //dd($tpenggunaan);
        } elseif (Auth::user()->jabatan->jabatan == 'KASI') {
            $tpenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
        } elseif (Auth::user()->jabatan->jabatan == 'PPBP') {
            $tpenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
        } elseif (Auth::user()->jabatan->jabatan == 'KASUBAG') {
            $tpenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
        } else {
            $tpenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
        }
        
        return view("Admin.Penggunaan.show", compact('periodeAktif', 'tpenggunaan'));
    }

    public function getDataPenggunaanPPBP($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();

        if (Auth::user()->jabatan->jabatan == 'PPBPB') {
            $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
        } elseif (Auth::user()->jabatan->jabatan == 'KASI') {
            if ($id == 1) {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('status_penggunaan', 'final')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
            } else {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
            }
        } elseif (Auth::user()->jabatan->jabatan == 'PPBP') {
            if ($id == 1) {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('status_penggunaan', 'approved')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            } else {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            }
        } elseif (Auth::user()->jabatan->jabatan == 'KASUBAG') {
            if ($id == 1) {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('status_penggunaan', 'disetujui_ppbp')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            } else {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            }
        } else {
                $dataPenggunaan = PenggunaanModel::with('opd', 'unit')->whereIn('status_penggunaan', ['final', 'approved', 'disetujui_ppbp', 'disetujui_atasanLangsung'])->get();
        }

        $tabel = view('Admin.Penggunaan.tabel', ['tpenggunaan' =>$dataPenggunaan])->render();

        return response()->json($tabel);
    }

    public function createPenggunaan()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpenerimaan = PenerimaanModel::where('status_penerimaan', 'final')->get();

        return view("Admin.Penggunaan.create", compact('periodeAktif', 'tpenerimaan'));
    }

    public function insertPenggunaan(Request $request)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();

        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'id_penerimaan' => 'required',
            'status_saldo' => 'required',
            'ket_penggunaan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidPenggunaan = PenggunaanModel::max('id');
        if ($lastestidPenggunaan) {
            $getLastestPenggunaan = PenggunaanModel::find($lastestidPenggunaan);
            $lastestKodePenggunaan = $getLastestPenggunaan->kode_penggunaan;
            if ($lastestKodePenggunaan) {
                $getKodePenggunaan = explode("/", $lastestKodePenggunaan);
                for ($i=0; $i < count($getKodePenggunaan); $i++) { 
                    echo $getKodePenggunaan[$i];
                }
            }else {
                $getKodePenggunaan[2] = "0";
            }
        } else {
            $getKodePenggunaan[2] = "0";
        }
        
        $newKodePenggunaan = $getKodePenggunaan[2] + 1;
        $penggunaanKode = $getOPD."/PGN/".$newKodePenggunaan;

        $penggunaan = new PenggunaanModel();
        $penggunaan->kode_penggunaan = $penggunaanKode;
        $penggunaan->tgl_penggunaan = $request->tgl_input;
        $penggunaan->id_penerimaan = $request->id_penerimaan;
        $penggunaan->status_penggunaan = $request->status_saldo;
        $penggunaan->ket_penggunaan = $request->ket_penggunaan;
        $penggunaan->id_periode = $dataPeriodeAktif->id;
        $penggunaan->id_opd = Auth::user()->opd->id;
        $penggunaan->id_unit = Auth::user()->unit->id;
        $penggunaan->save();
        
        return redirect()->route('editPenggunaan', ['id' => $penggunaan->id]);
    }

    public function editPenggunaan($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
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
        $penggunaan->update();

        return redirect()->route('penggunaan')->with('statusInput', 'Update Success');
    }

    public function getDataDetailPenerimaan($id)
    {
        $detailPenerimaan = DetailPenerimaanModel::with('barang.jenisBarang')->where('id_penerimaan',$id)->get();

        return response()->json($detailPenerimaan);
    }

    public function deletePenggunaan($id)
    {
        $detailPenggunaan = DetailPenggunaanModel::where('id_penggunaan', $id)->delete();

        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->delete();
        
        return redirect('/penggunaan')->with('statusInput', 'Delete Success');
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

        $penggunaan = PenggunaanModel::find($idPenggunaan);
        $penggunaan->kode_penggunaan = $request->kodePenggunaan;
        $penggunaan->tgl_penggunaan = $request->tglPenggunaan;
        $penggunaan->id_penerimaan = $idPenerimaan;
        $penggunaan->status_penggunaan = 'final';
        $penggunaan->total = $penerimaanData->total;
        $penggunaan->ket_penggunaan = $request->ketPenggunaan;
        $penggunaan->update();

        $penerimaan = PenerimaanModel::find($idPenerimaan)->update([
            'status_penerimaan' => 'digunakan'
        ]);

        return redirect()->route('penggunaan')->with('statusInput', 'Status Final Success');
    }

    public function approvedPenggunaan($id)
    {
        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->status_penggunaan = 'approved';
        $penggunaan->update();
        
        return redirect('/penggunaan')->with('statusInput', 'Approved Success');
    }
    
    public function disetujui_ppbpPenggunaan($id)
    {
        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->status_penggunaan = 'disetujui_ppbp';
        $penggunaan->update();
        
        return redirect('/penggunaan')->with('statusInput', 'Disetujui PPBP Success');
    }
    
    public function disetujui_atasanLangsungPenggunaan($id)
    {
        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->status_penggunaan = 'disetujui_atasanLangsung';
        $penggunaan->update();

        $idPenerimaan = $penggunaan->id_penerimaan;
        $penerimaan = PenerimaanModel::find($idPenerimaan);

        $dpenerimaan = DetailPenerimaanModel::whereIn('id_penerimaan', [$idPenerimaan])->get();

        foreach ($dpenerimaan as $dp) {
            $barangOPD = BarangOPDModel::where('id_opd', Auth::user()->opd->id)->where('id_barang', $dp->id_barang)->first();
            $idBarangOPD = BarangOPDModel::find($barangOPD->id);
            $idBarangOPD->qty = $idBarangOPD->qty - $dp->qty;
            $idBarangOPD->update(); 

            $barangUnit = BarangUnitModel::where('id_unit', Auth::user()->unit->id)->where('id_barang', $dp->id_barang)->first();
            $dataBarang = BarangModel::where('id', $dp->id_barang)->first();
            if ($barangUnit) {
                $finalPenerimaan = BarangUnitModel::find($barangUnit->id);
                $finalPenerimaan->qty = $finalPenerimaan->qty + $dp->qty;
                $finalPenerimaan->update();
            } else{
                $finalPenerimaan = new BarangUnitModel();
                $finalPenerimaan->id_unit = Auth::user()->unit->id;
                $finalPenerimaan->id_jenis = $dataBarang->id_jenis;
                $finalPenerimaan->id_barang = $dp->id_barang;
                $finalPenerimaan->qty = $finalPenerimaan->qty + $dp->qty;
                $finalPenerimaan->save();
            }
        }
        
        return redirect('/penggunaan')->with('statusInput', 'Disetujui Atasan Langsung Success');
    }
}
