<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PeriodeModel;
use App\OpnameModel;

class OpnameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dataOpname()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->unit->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $topname = OpnameModel::where('id_periode', $dataPeriodeAktif->id)->whereIn('id_opd', [Auth::user()->unit->opd->id])->get();

        return view("Admin.Opname.show", compact("periodeAktif", "topname"));
    }

    public function createOpname()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->unit->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Opname.create", compact("periodeAktif"));
    }

    public function editOpname()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->unit->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Opname.edit", compact("periodeAktif"));
    }
}
