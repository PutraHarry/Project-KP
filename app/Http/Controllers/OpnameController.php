<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PeriodeModel;
use App\OpnameModel;
use App\DetailOpnameModel;
use App\BarangModel;
use App\BarangUnitModel;
use App\JenisBarangModel;


class OpnameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataOpname()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        if (Auth::user()->jabatan->jabatan == 'PPBP') {
            $topname = OpnameModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
        } else {
            $topname = OpnameModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->whereIn('status_opname', ['final', 'digunakan'])->get();
        }

        return view("Admin.Opname.show", compact("periodeAktif", "topname"));
    }

    public function createOpname()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Opname.create", compact("periodeAktif"));
    }

    public function insertOpname(Request $request)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'status_opname' => 'required',
            'ket_opname' => 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidOpname = OpnameModel::max('id');
        if ($lastestidOpname) {
            $getLastestOpname = OpnameModel::find($lastestidOpname);
            $lastestKodeOpname = $getLastestOpname->kode_opname;
            if ($lastestKodeOpname) {
                $getKodeOpname = explode("/", $lastestKodeOpname);
                for ($i=0; $i < count($getKodeOpname); $i++) { 
                    echo $getKodeOpname[$i];
                }
            }else {
                $getKodeOpname[2] = "0";
            }
        } else {
            $getKodeOpname[2] = "0";
        }
        
        $newKodeOpname = $getKodeOpname[2] + 1;
        $opnameKode = $getOPD."/OPN/".$newKodeOpname;

        $opname = new OpnameModel();
        $opname->kode_opname = $opnameKode;
        $opname->tgl_opname = $request->tgl_input;
        $opname->status_opname = $request->status_opname;
        $opname->ket_opname = $request->ket_opname;
        $opname->id_periode = $dataPeriodeAktif->id;
        $opname->id_opd = Auth::user()->opd->id;
        $opname->id_unit = Auth::user()->unit->id;
        $opname->save();
        
        
        return redirect()->route('editOpname', ['id' => $opname->id]);
    }

    public function editOpname($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $topname = OpnameModel::find($id);
        $detailOpname = DetailOpnameModel::with('barang')->where('id_opname',$id)->get();
        $tbarang = BarangModel::get();
        $idEdit = $id;

        $barangUnit = BarangUnitModel::with('barang')->where('id_unit', Auth::user()->unit->id)->get();
        $jenisBarang = JenisBarangModel::get();

        return view("Admin.Opname.edit", compact("periodeAktif", "topname", "tbarang", "detailOpname", "idEdit", 'barangUnit', 'jenisBarang'));
    }

    public function updateOpname($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_opname' => 'required',
            'tgl_input' => 'required',
            'ket_opname' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $opname = OpnameModel::find($id);
        $opname->kode_opname = $request->kode_opname;
        $opname->tgl_opname = $request->tgl_input;
        $opname->ket_opname = $request->ket_opname;
        $opname->update();
        
        return redirect()->route('opname')->with('statusInput', 'Update Success');
    }

    public function getBarang($id)
    {
        $barangUnit = BarangUnitModel::with('barang')->where('id_unit', Auth::user()->unit->id)->where('id_jenis', $id)->get();

        return response()->json($barangUnit);
    }

    public function insertDetailOpname($id, Request $request)
    {
        $dataDetailBarang = BarangUnitModel::with('barang')->where('id_barang', $request->id_barang)->first();
        //dd($dataDetailPenggunaan);

        if ($request->qty > $dataDetailBarang->qty) {
            return redirect()->back()->with('statusInput', 'Barang yang dimasukkan melebihi stok');
        }

        $dopname = new DetailOpnameModel();
        $dopname->id_opname = $id;
        $dopname->id_barang = $request->id_barang;
        $dopname->qty = $request->qty;
        $dopname->harga = $request->total;
        $dopname->keterangan = $request->keterangan;
        $dopname->save();
      
        $mopname = OpnameModel::find($id);
        $mopname->total = $mopname->total + $request->total;
        $mopname->update();
      
        return redirect()->back();
    }

    public function editDetailOpname($id, Request $request)
    {
        //dd($id);
        $dopname = DetailOpnameModel::find($id);
        $newTotal = $request->total;
        $oldTotal = $dopname->total;
        $gapTotal = $newTotal-$oldTotal;

        $dopname->id_barang = $request->id_barang;
        $dopname->qty = $request->qty;
        $dopname->harga = $request->total;
        $dopname->keterangan = $request->keterangan;
        $dopname->update();

        $mopname = OpnameModel::find($dopname->id_opname);
        $mopname->total = $mopname->total + $gapTotal;
        $mopname->update();
        return redirect()->back();
    }

    public function deleteDetailOpname($id)
    {
        //dd($id);
        $detailOpname = DetailOpnameModel::find($id);
        $totaldelete = $detailOpname->harga;
        $opname = OpnameModel::where('id', $detailOpname->id_opname)->first();
        $opname->total = $opname->total - $totaldelete;
        $opname->update();

        $dopname = DetailOpnameModel::find($id);
        $dopname->delete();
        
        return response()->json();
    }

    public function deleteOpname($id)
    {
        $detailOpname = DetailOpnameModel::where('id_opname', $id)->delete();

        $opname = OpnameModel::find($id);
        $opname->delete();
        
        return redirect('/opname')->with('statusInput', 'Delete Success');
    }

    public function finalOpname($id, Request $request)
    {
        $opname = OpnameModel::find($id);
        $opname->kode_opname = $request->kodeOpname;
        $opname->tgl_opname = $request->tglOpname;
        $opname->ket_opname = $request->ketOpname;
        $opname->status_opname = 'final';
        $opname->update();

        $dopname = DetailOpnameModel::whereIn('id_opname', [$id])->get();

        foreach ($dopname as $do) {
            $barangUnit = BarangUnitModel::where('id_unit', Auth::user()->unit->id)->where('id_barang', $do->id_barang)->first();
            
            $finalPengeluaran = BarangUnitModel::find($barangUnit->id);
            $finalPengeluaran->qty = $finalPengeluaran->qty - $do->qty;
            $finalPengeluaran->update();
        }
        
        return redirect('/opname')->with('statusInput', 'Status Final Berhasil');
    }
}