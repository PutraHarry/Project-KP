<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodeModel;
use App\OPDModel;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataPeriode()
    {
        $periodes = PeriodeModel::get();

        $tperiode = PeriodeModel::orderby('created_at', 'desc')->get();

        return view("Admin.Periode.show", compact('tperiode', 'periodes'));
    }

    public function addPeriode()
    {
        $topd = OPDModel::get();

        return view("Admin.Periode.create", compact('topd'));
    }

    public function insertPeriode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_opd' => 'required',
            'nama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $periode = new PeriodeModel();
        $periode->id_opd = $request->id_opd;
        $periode->nama = $request->nama;
        $periode->tgl_mulai = $request->tgl_mulai;
        $periode->tgl_selesai = $request->tgl_selesai;
        $periode->status = $request->status;
        $periode->keterangan = $request->keterangan;

        $periode->save();

        return redirect('/periode')->with('StatusInput', 'Input Success');
    }

    public function bukaPeriode()
    {
        $bukaperiode = periodeModel::where('status', 'close')->get();

        return view("Admin.Periode.bukaperiode", compact('bukaperiode'));
    }

    public function tutupPeriode()
    {
        $tutupperiode = periodeModel::where('status', 'open')->get();

        return view("Admin.Periode.tutupperiode", compact('tutupperiode'));
    }
}
