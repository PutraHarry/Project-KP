<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PengeluaranModel;
use App\PeriodeModel;

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


        $tpengeluaran = PengeluaranModel::get();

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

        return view("Admin.Pengeluaran.create", compact('periodeAktif'));
    }

    public function editPengeluaran()
    {
        $open = ['open'];

        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        return view("Admin.Pengeluaran.edit", compact('periodeAktif'));
    }
}
