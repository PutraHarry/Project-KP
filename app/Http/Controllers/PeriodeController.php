<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\PeriodeModel;
use App\OPDModel;
use App\UnitModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPeriode()
    {
        $tperiode = DB::table('tb_periode')
                    ->join('tb_opd', 'tb_opd.id_opd', '=', 'tb_periode.id_opd')
                    ->get();

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Periode.show", compact('tperiode', 'periodeAktif'));
    }

    public function addPeriode()
    {
        $topd = OPDModel::get();

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Periode.create", compact('topd', 'periodeAktif'));
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

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Periode.bukaperiode", compact('bukaperiode', 'periodeAktif'));
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

        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Periode.tutupperiode", compact('tutupperiode', 'periodeAktif'));
    }
    
    public function prosesTutup($id)
    {
        $lastest_id = PeriodeModel::max('id');
        $tutupperiode = PeriodeModel::find($id);
        $tutupperiode->status_periode = 'close';
        $tutupperiode->update();

        if($tutupperiode->id == $lastest_id){
            $tanggal_selesai_sebelum = $tutupperiode->tgl_selesai;
            $tanggal_mulai_baru = Carbon::parse($tanggal_selesai_sebelum)->addDays(1);
            $tanggal_selesai_baru = Carbon::parse($tanggal_mulai_baru)->addMonths(1)->subDays(1);

            //Nama Periode
            $nama_bulan = $tanggal_mulai_baru->locale('id')->monthName;
            $nama_tahun = $tanggal_mulai_baru->locale('id')->year;
            $nama_periode = "Periode ".$nama_bulan." ".$nama_tahun;

            //Get Opd Id
            // $user = Auth::user()->id;
            // $unit = UnitModel::find($user->id_unit);
            // $opd_id = OPDModel::find($unit->id_opd)->id;

            //Periode Baru
            $periode_baru = new PeriodeModel();
            $periode_baru->id_opd = Auth::user()->unit->opd->id_opd;
            $periode_baru->nama_periode = $nama_periode;
            $periode_baru->tgl_mulai = $tanggal_mulai_baru;
            $periode_baru->tgl_selesai = $tanggal_selesai_baru;
            $periode_baru->status_periode = "open";
            $periode_baru->ket_periode = $nama_periode;
            $periode_baru->save();
        }


        return redirect('/periode/tutupperiode')->with('statusInput', 'Tutup Periode Berhasil');
    }
}
