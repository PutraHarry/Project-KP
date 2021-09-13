<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenerimaanModel;
use App\BarangModel;
use App\PeriodeModel;
use Illuminate\Support\Facades\Validator;
use DB;

class PenerimaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataPenerimaan()
    {
        $tpenerimaanobat = PenerimaanModel::where('jenis_penerimaan', 'APBD Obat')->get();
        $tpenerimaannonobat = PenerimaanModel::where('jenis_penerimaan', 'APBD Non Obat')->get();
        $tpenerimaanhibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Obat')->get();
        $tpenerimaannonhibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Non Obat')->get();
        $tpenerimaannonapbd = PenerimaanModel::where('jenis_penerimaan', 'Non APBD')->get();
        
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Penerimaan.show", compact("tpenerimaanobat","tpenerimaannonobat","tpenerimaanhibah","tpenerimaannonhibah","tpenerimaannonapbd", "periodeAktif"));
    }

    public function addPenerimaan()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Penerimaan.create", "periodeAktif");
    }

    public function editPenerimaan()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Penerimaan.edit", "periodeAktif");
    }
}
