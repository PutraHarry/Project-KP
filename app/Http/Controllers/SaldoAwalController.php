<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaldoAwalModel;
use App\BarangModel;
use App\DetailSaldoAwalModel;
use App\PeriodeModel;
use App\BarangOPDModel;
use App\GudangOPDModel;
use App\barangUnitModel;
use App\JenisBarangModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SaldoAwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataSaldoAwal()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        if (Auth::user()->jabatan->jabatan == 'PPBPB') {
            $saldoawal = SaldoAwalModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_unit', [Auth::user()->unit->id])->get();
        } elseif (Auth::user()->jabatan->jabatan == 'PPBP') {
            $saldoawal = SaldoAwalModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->opd->id])->where('status_saldo', 'final')->get();
        } else {
            $saldoawal = SaldoAwalModel::where('id_periode', $dataPeriodeAktif->id)->where('status_saldo', 'final')->get();
        }
        
        return view("Admin.Saldo.show", compact("periodeAktif", "saldoawal"));
    }

    public function addSaldoAwal()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Saldo.create", compact("periodeAktif"));
    }

    public function insertSaldoAwal(Request $request)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();

        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'ket_saldo' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidSaldoAwal = SaldoAwalModel::max('id');
        if ($lastestidSaldoAwal) {
            $getLastestSaldoAwal = SaldoAwalModel::find($lastestidSaldoAwal);
            $lastestKodeSaldoAwal = $getLastestSaldoAwal->kode_saldo;
            if ($lastestKodeSaldoAwal) {
                $getKodeSaldoAwal = explode("/", $lastestKodeSaldoAwal);
                for ($i=0; $i < count($getKodeSaldoAwal); $i++) { 
                    echo $getKodeSaldoAwal[$i];
                }
            }else {
                $getKodeSaldoAwal[2] = "0";
            }
        } else {
            $getKodeSaldoAwal[2] = "0";
        }
        
        $newKodeSaldoAwal = $getKodeSaldoAwal[2] + 1;
        $saldoAwalKode = $getOPD."/SDA/".$newKodeSaldoAwal;

        $saldoawal = new SaldoAwalModel();
        $saldoawal->kode_saldo = $saldoAwalKode;
        $saldoawal->tgl_input = $request->tgl_input;
        $saldoawal->status_saldo = 'draft';
        $saldoawal->ket_saldo = $request->ket_saldo;
        $saldoawal->id_opd = Auth::user()->opd->id;
        $saldoawal->id_unit = Auth::user()->unit->id;
        $saldoawal->id_periode = $dataPeriodeAktif->id;
        $saldoawal->save();
        
        
        return redirect()->route('editSaldoAwal', ['id' => $saldoawal->id]);
    }

    public function editSaldoAwal($id)
    {
        $saldoawal = SaldoAwalModel::find($id);
        $tbarang = BarangModel::get();
        $idEdit = $id;

        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $detailSaldoAwal = DetailSaldoAwalModel::with('barang.jenisBarang')->where('id_saldo',$id)->get();
        $jenisBarang = JenisBarangModel::get();
        // dd($jenisBarang);
        
        return view("Admin.Saldo.edit", compact('saldoawal', 'tbarang', 'idEdit', 'detailSaldoAwal', "periodeAktif", 'jenisBarang'));
    }

    public function updateSaldoAwal($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'ket_saldo' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $saldoawal = SaldoAwalModel::find($id);
        $saldoawal->tgl_input = $request->tgl_input;
        $saldoawal->ket_saldo = $request->ket_saldo;
        $saldoawal->update();
        return redirect('/saldoawal')->with('statusInput', 'Update Success');
    }

    public function getBarang($id)
    {
        $barang = BarangModel::where('id_jenis', $id)->get();

        return response()->json($barang);
    }
    
    public function insertDetailSaldoBarang($id, Request $request)
    {
        //dd($id);
        $dsaldoawal = new DetailSaldoAwalModel();
        $dsaldoawal->id_saldo = $id;
        $dsaldoawal->id_barang = $request->id_barang;
        $dsaldoawal->qty = $request->qty;
        $dsaldoawal->harga = $request->total;
        $dsaldoawal->keterangan = $request->keterangan;
        $dsaldoawal->save();
      
        $msaldoawal = SaldoAwalModel::find($id);
        $msaldoawal->total = $msaldoawal->total + $request->total;
        $msaldoawal->update();
      
        return redirect()->back();
    }

    public function editDetailSaldoBarang($id, Request $request)
    {
        //dd($id);
        $dsaldoawal = DetailSaldoAwalModel::find($id);

        $newTotal = $request->total;
        $oldTotal = $dsaldoawal->total;
        $gapTotal = $newTotal-$oldTotal;

        $dsaldoawal->qty = $request->qty;
        $dsaldoawal->harga = $request->total;
        $dsaldoawal->update();

        $msaldoawal = SaldoAwalModel::find($dsaldoawal->id_saldo);
        $msaldoawal->total = $msaldoawal->total + $gapTotal;
        $msaldoawal->update();
        return redirect()->back();
    }

    public function deleteDetailSaldoAwal($id)
    {
        //dd($id);
        $detailSaldoAwal = DetailSaldoAwalModel::find($id);
        $totaldelete = $detailSaldoAwal->harga;
        $saldoawal = SaldoAwalModel::where('id', $detailSaldoAwal->id_saldo)->first();
        $saldoawal->total = $saldoawal->total - $totaldelete;
        $saldoawal->update();

        $dsaldoawal = DetailSaldoAwalModel::find($id);
        $dsaldoawal->delete();
        
        return response()->json();
    }

    public function deleteSaldoAwal($id)
    {
        $saldoawal = SaldoAwalModel::find($id);
        $saldoawal->delete();
        
        return redirect('/saldoawal')->with('statusInput', 'Delete Success');
    }

    public function finalSaldoAwal($id, Request $request)
    {
        $saldoawal = SaldoAwalModel::find($id);
        $saldoawal->tgl_input = $request->tglSaldoAwal;
        $saldoawal->ket_saldo = $request->ketSaldoAwal;
        $saldoawal->status_saldo = 'final';
        $saldoawal->update();

        $dsaldoawal = DetailSaldoAwalModel::whereIn('id_saldo', [$id])->get();
        
        foreach ($dsaldoawal as $ds) {
            $barangUnit = BarangUnitModel::where('id_unit', Auth::user()->unit->id)->where('id_barang', $ds->id_barang)->first();
            // dd($barangOPD);
            if ($barangUnit) {
                $finalSaldoAwal = BarangUnitModel::find($barangUnit->id);
                $finalSaldoAwal->qty = $finalSaldoAwal->qty + $ds->qty;
                $finalSaldoAwal->update();
            } else{
                $finalSaldoAwal = new BarangUnitModel();
                $finalSaldoAwal->id_barang = $ds->id_barang;
                $finalSaldoAwal->qty = $finalSaldoAwal->qty + $ds->qty;
                $finalSaldoAwal->save();
            }
        }
        
        return redirect('/saldoawal')->with('statusInput', 'Status Final Berhasil');
    }
}
