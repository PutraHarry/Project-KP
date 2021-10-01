<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaldoAwalModel;
use App\BarangModel;
use App\DetailSaldoAwalModel;
use App\PeriodeModel;
use Illuminate\Support\Facades\Validator;
use DB;

class SaldoAwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataSaldoAwal()
    {
        $tsaldo = SaldoAwalModel::get();

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Saldo.show", compact("tsaldo", "periodeAktif"));
    }

    public function addSaldoAwal()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }



        return view("Admin.Saldo.create", compact("periodeAktif"));
    }

    public function insertSaldoAwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_saldo' => 'required',
            'tgl_input' => 'required',
            'ket_saldo' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $saldoawal = new SaldoAwalModel();
        $saldoawal->kode_saldo = $request->kode_saldo;
        $saldoawal->tgl_input = $request->tgl_input;
        $saldoawal->status_saldo = 'draft';
        $saldoawal->ket_saldo = $request->ket_saldo;
        $saldoawal->save();
        
        
        return redirect()->route('saldoawaledit', ['id' => $saldoawal->id]);
    }

    public function editSaldoAwal($id)
    {
        $saldoawal = SaldoAwalModel::find($id);
        $tbarang = BarangModel::get();
        $idEdit = $id;

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $detailSaldoAwal = DetailSaldoAwalModel::with('barang')->where('id_saldo',$id)->get();
        
        return view("Admin.Saldo.edit", compact('saldoawal', 'tbarang', 'idEdit', 'detailSaldoAwal', "periodeAktif"));
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


        $dsaldoawal->id_barang = $request->id_barang;
        $dsaldoawal->qty = $request->qty;
        $dsaldoawal->harga = $request->total;
        $dsaldoawal->keterangan = $request->keterangan;
        $dsaldoawal->update();

        $msaldoawal = SaldoAwalModel::find($dsaldoawal->id_saldo);
        $msaldoawal->total = $msaldoawal->total + $gapTotal;
        $msaldoawal->update();
        return redirect()->back();
    }

    public function prosesFinal($id)
    {
        $saldoawal = SaldoAwalModel::find($id);
        $saldoawal->status_saldo = 'final';
        $saldoawal->update();
        
        return redirect('/saldoawal')->with('statusInput', 'Status Final Berhasil');
    }
}
