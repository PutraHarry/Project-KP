<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaldoAwalModel;
use Illuminate\Support\Facades\Validator;
use DB;

class SaldoAwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataSaldoAwal()
    {
        $tsaldo = SaldoAwalModel::get();

        return view("Admin.Saldo.show", compact("tsaldo"));
    }

    public function addSaldoAwal()
    {
        return view("Admin.Saldo.create");
    }

    public function insertSaldoAwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_saldo' => 'required',
            'tgl_input' => 'required',
            'status_saldo' => 'required',
            'ket_saldo' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $saldoawal = new SaldoAwalModel();
        $saldoawal->kode_saldo = $request->kode_saldo;
        $saldoawal->tgl_input = $request->tgl_input;
        $saldoawal->status_saldo = $request->status_saldo;
        $saldoawal->ket_saldo = $request->ket_saldo;
        $saldoawal->save();
        return redirect('/saldoawal')->with('StatusInput', 'Input Success');
    }
}
