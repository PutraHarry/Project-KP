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

class PengeluaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datapengeluaran()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }


        $tpengeluaran = PengeluaranModel::where('id_periode', $dataPeriodeAktif->id)->get();

        return view("Admin.Pengeluaran.show", compact('periodeAktif', 'tpengeluaran'));
    }

    public function createPengeluaran()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpenggunaan = PenggunaanModel::get();

        return view("Admin.Pengeluaran.create", compact('periodeAktif', 'tpenggunaan'));
    }

    public function insertPengeluaran(Request $request)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', ['open'])->first();

        $validator = Validator::make($request->all(), [
            'kode_pengeluaran' => 'required',
            'tgl_input' => 'required',
            'id_penggunaan' => 'required',
            'status_pengeluaran' => 'required',
            'ket_pengeluaran' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $pengeluaran = new PengeluaranModel();
        $pengeluaran->kode_pengeluaran = $request->kode_pengeluaran;
        $pengeluaran->tgl_keluar = $request->tgl_input;
        $pengeluaran->id_penggunaan = $request->id_penggunaan;
        $pengeluaran->status_pengeluaran = $request->status_pengeluaran;
        $pengeluaran->ket_pengeluaran = $request->ket_pengeluaran;
        $pengeluaran->id_periode = $dataPeriodeAktif->id;
        $pengeluaran->save();

        return redirect()->route('editPengeluaran', ['id' => $pengeluaran->id]);
    }

    public function editPengeluaran($id)
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $tpengeluaran = PengeluaranModel::find($id);
        $tpenggunaan = PenggunaanModel::get();
        $idEdit = $id;

        return view("Admin.Pengeluaran.edit", compact('periodeAktif', 'idEdit', 'tpengeluaran', 'tpenggunaan'));
    }

    public function getDataDetailPenggunaan($id)
    {
        $detailPenggunaan = DetailPenggunaanModel::with('barang')->where('id_penggunaan',$id)->get();

        return response()->json($detailPenggunaan);
    }

    public function updatePengeluaran($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_pengeluaran' => 'required',
            'tgl_input' => 'required',
            'id_penggunaan' => 'required',
            'ket_pengeluaran' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $pengeluaran = PengeluaranModel::find($id);
        $pengeluaran->kode_pengeluaran = $request->kode_pengeluaran;
        $pengeluaran->tgl_keluar = $request->tgl_input;
        $pengeluaran->id_penggunaan = $request->id_penggunaan;
        $pengeluaran->ket_pengeluaran = $request->ket_pengeluaran;
        //dd($penggunaan);
        $pengeluaran->update();

        return redirect()->route('pengeluaran')->with('statusInput', 'Update Success');
    }

    public function deletePengeluaran($id)
    {
        $detailPengeluaran = DetailPengeluaranModel::where('id_pengeluaran', $id)->delete();

        $pengeluaran = PengeluaranModel::find($id);
        $pengeluaran->delete();
        
        return redirect('/pengeluaran')->with('statusInput', 'Delete Success');
    }

    public function finalPengeluaran($idPengeluaran, $idPenggunaan, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tglPengeluaran' => 'required',
            'kodePenggunaan' => 'required',
            'kodePengeluaran' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $penggunaanData = PenggunaanModel::find($idPenggunaan);
        //dd($Penerimaandata);

        $pengeluaran = PengeluaranModel::find($idPengeluaran);
        $pengeluaran->kode_pengeluaran = $request->kodePengeluaran;
        $pengeluaran->tgl_keluar = $request->tglPengeluaran;
        $pengeluaran->id_penggunaan = $idPenggunaan;
        $pengeluaran->status_pengeluaran = 'final';
        $pengeluaran->total = $penggunaanData->total;
        $pengeluaran->ket_pengeluaran = $request->ketPengeluaran;
        $pengeluaran->update();

        $penggunaanDetail = DetailPenggunaanModel::whereIn('id_penggunaan', [$idPenggunaan])->get();
        //dd($penerimaan);

        foreach ($penggunaanDetail as $dataPenggunaan) {
            $detailPengeluaran = new DetailPengeluaranModel();
            $detailPengeluaran->id_pengeluaran = $idPengeluaran;
            $detailPengeluaran->id_barang = $dataPenggunaan->id_barang;
            $detailPengeluaran->qty = $dataPenggunaan->qty;
            $detailPengeluaran->harga = $dataPenggunaan->harga;
            $detailPengeluaran->keterangan = $dataPenggunaan->keterangan;
            //dd($detailPenggunaan);
            $detailPengeluaran->save();
        }

        return redirect()->route('pengeluaran')->with('statusInput', 'Status Final Success');
    }
}
