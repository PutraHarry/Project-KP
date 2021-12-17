<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PengeluaranModel;
use App\PeriodeModel;
use App\PenggunaanModel;
use App\DetailPenggunaanModel;
use App\DetailPengeluaranModel;
use App\BarangUnitModel;
use App\BarangModel;
use App\KegiatanModel;
use App\JenisBarangModel;

class PengeluaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPengeluaran()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        if (Auth::user()->jabatan->jabatan == 'PPBPB') {
            $tpengeluaran = PengeluaranModel::where('id_periode', $dataPeriodeAktif->id)->where('id_unit', [Auth::user()->unit->id])->get();
        } else {
            $tpengeluaran = PengeluaranModel::where('id_periode', $dataPeriodeAktif->id)->where('id_opd', [Auth::user()->opd->id])->where('status_pengeluaran', 'final')->get();
        }

        return view("Admin.Pengeluaran.show", compact('periodeAktif', 'tpengeluaran'));
    }

    public function createPengeluaran()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $kegiatan = KegiatanModel::get();

        return view("Admin.Pengeluaran.create", compact('periodeAktif', 'kegiatan'));
    }

    public function insertPengeluaran(Request $request)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        $validator = Validator::make($request->all(), [
            'tgl_input' => 'required',
            'status_pengeluaran' => 'required',
            'ket_pengeluaran' => 'required',
            'kegiatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $getOPD = Auth::user()->opd->nama_opd;
        $lastestidPengeluaran = PengeluaranModel::max('id');
        if ($lastestidPengeluaran) {
            $getLastestPengeluaran = PengeluaranModel::find($lastestidPengeluaran);
            $lastestKodePengeluaran = $getLastestPengeluaran->kode_pengeluaran;
            if ($lastestKodePengeluaran) {
                $getKodePengeluaran = explode("/", $lastestKodePengeluaran);
                for ($i=0; $i < count($getKodePengeluaran); $i++) { 
                    echo $getKodePengeluaran[$i];
                }
            }else {
                $getKodePengeluaran[2] = "0";
            }
        } else {
            $getKodePengeluaran[2] = "0";
        }
        
        $newKodePengeluaran = $getKodePengeluaran[2] + 1;
        $pengeluaranKode = $getOPD."/PGL/".$newKodePengeluaran;

        $pengeluaran = new PengeluaranModel();
        $pengeluaran->kode_pengeluaran = $pengeluaranKode;
        $pengeluaran->tgl_keluar = $request->tgl_input;
        $pengeluaran->status_pengeluaran = $request->status_pengeluaran;
        $pengeluaran->ket_pengeluaran = $request->ket_pengeluaran;
        $pengeluaran->id_m_kegiatan = $request->kegiatan;
        $pengeluaran->id_periode = $dataPeriodeAktif->id;
        $pengeluaran->id_opd = Auth::user()->opd->id;
        $pengeluaran->id_unit = Auth::user()->unit->id;
        $pengeluaran->save();

        return redirect()->route('editPengeluaran', ['id' => $pengeluaran->id]);
    }

    public function editPengeluaran($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $tbarang = BarangModel::get();
        $tpengeluaran = PengeluaranModel::find($id);
        $tpenggunaan = PenggunaanModel::get();
        $dataPenggunaan = PenggunaanModel::find($tpengeluaran->id_penggunaan);
        $idEdit = $id;
        $kegiatan = KegiatanModel::get();

        $barangUnit = BarangUnitModel::with('barang')->where('id_unit', Auth::user()->unit->id)->get();
        //dd($barangPenggunaan);
        $detailPengeluaran = DetailPengeluaranModel::with('barang.jenisBarang')->where('id_pengeluaran',$id)->get();
        $jenisBarang = JenisBarangModel::get();

        return view("Admin.Pengeluaran.edit", compact('periodeAktif', 'idEdit', 'tpengeluaran', 'tpenggunaan', 'barangUnit', 'tbarang', 'detailPengeluaran', 'kegiatan', 'jenisBarang'));
    }

    public function getBarang($id)
    {
        $barangUnit = BarangUnitModel::with('barang')->where('id_unit', Auth::user()->unit->id)->where('id_jenis', $id)->get();

        return response()->json($barangUnit);
    }

    public function insertDetailPengeluaran($id, Request $request)
    {
        $dataDetailPenggunaan = BarangUnitModel::with('barang')->where('id_barang', $request->id_barang)->first();
        //dd($dataDetailPenggunaan);

        if ($request->qty > $dataDetailPenggunaan->qty) {
            return redirect()->back()->with('statusInput', 'Barang yang dimasukkan melebihi stok');
        }
        
        $dpengeluaran = new DetailPengeluaranModel();
        $dpengeluaran->id_pengeluaran = $id;
        $dpengeluaran->id_barang = $request->id_barang;
        $dpengeluaran->qty = $request->qty;
        $dpengeluaran->harga = $request->total;
        $dpengeluaran->keterangan = $request->keterangan;
        $dpengeluaran->save();
    
        $mpengeluaran = PengeluaranModel::find($id);
        $mpengeluaran->total = $mpengeluaran->total + $request->total;
        $mpengeluaran->update();
    
        return redirect()->back();
    }

    public function editDetailPengeluaran($id, Request $request)
    {
        //dd($id);
        $dpengeluaran = DetailPengeluaranModel::find($id);

        $newTotal = $request->total;
        $oldTotal = $dpengeluaran->total;
        $gapTotal = $newTotal-$oldTotal;


        $dpengeluaran->id_barang = $request->id_barang;
        $dpengeluaran->qty = $request->qty;
        $dpengeluaran->harga = $request->total;
        $dpengeluaran->keterangan = $request->keterangan;
        $dpengeluaran->update();

        $mpengeluaran = PengeluaranModel::find($dpengeluaran->id_saldo);
        $mpengeluaran->total = $mpengeluaran->total + $gapTotal;
        $mpengeluaran->update();
        return redirect()->back();
    }

    public function updatePengeluaran($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pengeluaran' => 'required',
            'tgl_input' => 'required',
            'id_penggunaan' => 'required',
            'ket_pengeluaran' => 'required',
            'kegiatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $pengeluaran = PengeluaranModel::find($id);
        $pengeluaran->kode_pengeluaran = $request->kode_pengeluaran;
        $pengeluaran->tgl_keluar = $request->tgl_input;
        $pengeluaran->ket_pengeluaran = $request->ket_pengeluaran;
        $pengeluaran->id_m_kegiatan = $request->kegiatan;
        //dd($penggunaan);
        $pengeluaran->update();

        return redirect()->route('pengeluaran')->with('statusInput', 'Update Success');
    }

    public function deleteDetailPengeluaran($id)
    {
        //dd($id);
        $detailPengeluaran = DetailPengeluaranModel::find($id);
        $totaldelete = $detailPengeluaran->harga;
        $pengeluaran = PengeluaranModel::where('id', $detailPengeluaran->id_pengeluaran)->first();
        $pengeluaran->total = $pengeluaran->total - $totaldelete;
        $pengeluaran->update();

        $dpengeluaran = DetailPengeluaranModel::find($id);
        $dpengeluaran->delete();
        
        return response()->json();
    }

    public function deletePengeluaran($id)
    {
        $detailPengeluaran = DetailPengeluaranModel::where('id_pengeluaran', $id)->delete();

        $pengeluaran = PengeluaranModel::find($id);
        $pengeluaran->delete();
        
        return redirect('/pengeluaran')->with('statusInput', 'Delete Success');
    }

    public function finalPengeluaran($idPengeluaran, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tglPengeluaran' => 'required',
            'kodePengeluaran' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
       
        //dd($dpengeluaran);
        $pengeluaran = PengeluaranModel::find($idPengeluaran);
        $pengeluaran->kode_pengeluaran = $request->kodePengeluaran;
        $pengeluaran->tgl_keluar = $request->tglPengeluaran;
        $pengeluaran->status_pengeluaran = 'final';
        $pengeluaran->ket_pengeluaran = $request->ketPengeluaran;
        $pengeluaran->update();

        $dpengeluaran = DetailPengeluaranModel::whereIn('id_pengeluaran', [$idPengeluaran])->get();

        foreach ($dpengeluaran as $dp) {
            $barangUnit = BarangUnitModel::where('id_unit', Auth::user()->unit->id)->where('id_barang', $dp->id_barang)->first();
            // dd($barangunit);
            
            $finalPengeluaran = BarangUnitModel::find($barangUnit->id);
            $finalPengeluaran->qty = $finalPengeluaran->qty - $dp->qty;
            $finalPengeluaran->update();
        }

        return redirect()->route('pengeluaran')->with('statusInput', 'Status Final Success');
    }
}
