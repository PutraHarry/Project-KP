<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodeModel;
use App\OPDModel;
use Illuminate\Support\Facades\Validator;
use DB;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /*public function PeriodeAktif()
    {
        $open = ['open'];

        $dataPeriode = PeriodeModel::whereIn('status_periode', $open)->first();

        return view("layouts.topbar", compact('dataPeriode'));
    }*/

    public function dataPeriode()
    {
        $tperiode = DB::table('tb_periode')
                    ->join('tb_opd', 'tb_opd.id_opd', '=', 'tb_periode.id_opd')
                    ->get();

        return view("Admin.Periode.show", compact('tperiode'));
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
            'nama_periode' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'status_periode' => 'required',
            'ket_periode' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $periode = new PeriodeModel();
        $periode->id_opd = $request->id_opd;
        $periode->nama_periode = $request->nama_periode;
        $periode->tgl_mulai = $request->tgl_mulai;
        $periode->tgl_selesai = $request->tgl_selesai;
        $periode->status_periode = $request->status_periode;
        $periode->ket_periode = $request->ket_periode;

        $periode->save();

        return redirect('/periode')->with('StatusInput', 'Input Success');
    }

    public function bukaPeriode()
    {
        $bukaperiode = DB::table('tb_periode')
                       ->join('tb_opd', 'tb_opd.id_opd', '=', 'tb_periode.id_opd')
                       ->where('status_periode', 'close')
                       ->get();

        return view("Admin.Periode.bukaperiode", compact('bukaperiode'));
    }

    public function prosesBuka($id)
    {
        $open = ['open'];

        $dataPeriode = PeriodeModel::whereIn('status_periode', $open)->first();
        
        //dd($id_dataPeriode);
        if($dataPeriode){
            $id_dataPeriode = $dataPeriode->id;

            $ubah_dataPeriode = PeriodeModel::find($id_dataPeriode);
            $ubah_dataPeriode->status_periode = 'close';
            $ubah_dataPeriode->update();
        }

        //dd($id);
        $bukaperiode = PeriodeModel::find($id);
        $bukaperiode->status_periode = 'open';
        $bukaperiode->update();

        return redirect('/periode/bukaperiode')->with('statusInput', 'Buka Periode Berhasil');
    }

    public function tutupPeriode()
    {
        $tutupperiode = DB::table('tb_periode')
                        ->join('tb_opd', 'tb_opd.id_opd', '=', 'tb_periode.id_opd')
                        ->where('status_periode', 'open')
                        ->get();

        return view("Admin.Periode.tutupperiode", compact('tutupperiode'));
    }
    
    public function prosesTutup($id)
    {
        $tutupperiode = PeriodeModel::find($id);
        $tutupperiode->status_periode = 'close';
        $tutupperiode->update();

        return redirect('/periode/tutupperiode')->with('statusInput', 'Tutup Periode Berhasil');
    }
}
