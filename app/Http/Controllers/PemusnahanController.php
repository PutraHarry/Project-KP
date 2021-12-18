<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PeriodeModel;
use App\PemusnahanModel;
use App\DetailPemusnahanModel;
use App\BarangModel;
use App\OpnameModel;
use App\DetailOpnameModel;

class PemusnahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPemusnahan()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        if (Auth::user()->jabatan->jabatan == 'PPBPB') {
            $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
        } elseif (Auth::user()->jabatan->jabatan == 'PPBP') {
            $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->where('status_pemusnahan', 'final')->get();
        } elseif (Auth::user()->jabatan->jabatan == 'Kepala PD') {
            $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->where('status_pemusnahan', 'final')->get();
        } elseif (Auth::user()->jabatan->jabatan == 'TIM VERIFIKASI') {
            $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->where('status_pemusnahan', 'final')->get();
        }

        return view("Admin.Pemusnahan.show", compact('periodeAktif', 'tpemusnahan'));
    }

    public function getDataPemusnahan($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();

        if (Auth::user()->jabatan->jabatan == 'PPBPB') {
            $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
        } elseif (Auth::user()->jabatan->jabatan == 'PPBP') {
            if ($id == 1) {
                $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->where('status_pemusnahan', 'final')->get();
            } else {
                $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            }
        } elseif (Auth::user()->jabatan->jabatan == 'Kepala PD') {
            if ($id == 1) {
                $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->where('status_pemusnahan', 'disetujui_ppbp')->get();
            } else {
                $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->get();
            }
        } elseif (Auth::user()->jabatan->jabatan == 'TIM VERIFIKASI') {
            if ($id == 1) {
                $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->where('status_pemusnahan', 'disetujui_kepalaPD')->get();
            } else {
                $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->get();
            }
        } else {
            $tpemusnahan = PemusnahanModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('status_pemusnahan', ['final', 'disetujui_ppbp', 'disetujui_kepalaPD', 'disetujui_timVerifikasi'])->get();
        }

        $tabel = view('Admin.Pemusnahan.tabel', ['tpemusnahan' =>$tpemusnahan])->render();

        return response()->json($tabel);
    }

    public function createPemusnahan()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $topname = OpnameModel::get();

        return view("Admin.Pemusnahan.create", compact('periodeAktif', 'topname'));
    }

    public function insertPemusnahan(Request $request)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();

        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'id_opname' => 'required',
            'status_pemusnahan' => 'required',
            'ket_pemusnahan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidPemusnahan = PemusnahanModel::max('id');
        if ($lastestidPemusnahan) {
            $getLastestPemusnahan = PemusnahanModel::find($lastestidPemusnahan);
            $lastestKodePemusnahan = $getLastestPemusnahan->kode_pemusnahan;
            if ($lastestKodePemusnahan) {
                $getKodePemusnahan = explode("/", $lastestKodePemusnahan);
                for ($i=0; $i < count($getKodePemusnahan); $i++) { 
                    echo $getKodePemusnahan[$i];
                }
            }else {
                $getKodePemusnahan[2] = "0";
            }
        } else {
            $getKodePemusnahan[2] = "0";
        }
        
        $newKodePemusnahan = $getKodePemusnahan[2] + 1;
        $pemusnahanKode = $getOPD."/PMS/".$newKodePemusnahan;

        $pemusnahan = new PemusnahanModel();
        $pemusnahan->kode_pemusnahan = $pemusnahanKode;
        $pemusnahan->tgl_pemusnahan = $request->tgl_input;
        $pemusnahan->id_opname = $request->id_opname;
        $pemusnahan->status_pemusnahan = $request->status_pemusnahan;
        $pemusnahan->ket_pemusnahan = $request->ket_pemusnahan;
        $pemusnahan->id_periode = $dataPeriodeAktif->id;
        $pemusnahan->id_opd = Auth::user()->opd->id;
        $pemusnahan->id_unit = Auth::user()->unit->id;
        $pemusnahan->save();
        
        return redirect()->route('editPemusnahan', ['id' => $pemusnahan->id]);
    }

    public function editPemusnahan($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpemusnahan = PemusnahanModel::find($id);
        $topname = OpnameModel::get();
        $idEdit = $id;

        return view("Admin.Pemusnahan.edit", compact('periodeAktif', 'tpemusnahan', 'idEdit', 'topname'));
    }

    public function updatePemusnahan($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'id_opname' => 'required',
            'ket_pemusnahan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $pemusnahan = PemusnahanModel::find($id);
        $pemusnahan->tgl_pemusnahan = $request->tgl_input;
        $pemusnahan->id_opname = $request->id_opname;
        $pemusnahan->ket_pemusnahan = $request->ket_pemusnahan;
        $pemusnahan->update();

        return redirect()->route('pemusnahan')->with('statusInput', 'Update Success');
    }

    public function getDataDetailOpname($id)
    {
        $detailOpname = DetailOpnameModel::with('barang')->where('id_opname',$id)->get();

        return response()->json($detailOpname);
    }

    public function deletePemusnahan($id)
    {
        $detailPemusnahan = DetailPemusnahanModel::where('id_pemusnahan', $id)->delete();

        $pemusnahan = PemusnahanModel::find($id);
        $pemusnahan->delete();
        
        return redirect('/pemusnahan')->with('statusInput', 'Delete Success');
    }

    public function finalPemusnahan($idPemusnahan, $idOpname, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tglPemusnahan' => 'required',
            'kodeOpname' => 'required',
            'kodePemusnahan' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $opnameData = OpnameModel::find($idOpname);
        //dd($Penerimaandata);

        $pemusnahan = PemusnahanModel::find($idPemusnahan);
        $pemusnahan->kode_pemusnahan = $request->kodePemusnahan;
        $pemusnahan->tgl_pemusnahan = $request->tglPemusnahan;
        $pemusnahan->id_opname = $idOpname;
        $pemusnahan->status_pemusnahan = 'final';
        $pemusnahan->total = $opnameData->total;
        $pemusnahan->ket_pemusnahan = $request->ketPemusnahan;
        $pemusnahan->update();

        $statusOpname = OpnameModel::where('id', $idOpname)->update([
            'status_opname' => 'Digunakan'
        ]);

        return redirect()->route('pemusnahan')->with('statusInput', 'Status Final Success');
    }

    public function disetujuiPPBPPenggunaan($id)
    {
        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->status_penggunaan = 'disetujui_ppbp';
        $penggunaan->update();
        
        return redirect('/penggunaan')->with('statusInput', 'Disetujui PPBP Success');
    }
    public function disetujuiKepalaPDPenggunaan($id)
    {
        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->status_penggunaan = 'disetujui_kepalaPD';
        $penggunaan->update();
        
        return redirect('/penggunaan')->with('statusInput', 'Disetujui Kepala PD Success');
    }
    public function disetujuiTimVerifikasiPenggunaan($id)
    {
        $penggunaan = PenggunaanModel::find($id);
        $penggunaan->status_penggunaan = 'disetujui_timVerifikasi';
        $penggunaan->update();
        
        return redirect('/penggunaan')->with('statusInput', 'Disetujui Tim Verifikasi Success');
    }
}
