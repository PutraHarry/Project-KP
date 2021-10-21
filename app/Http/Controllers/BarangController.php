<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PeriodeModel;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dataBarang()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("Admin.Master-Barang.show", compact("periodeAktif"));
    }

    public function createBarang()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("Admin.Master-Barang.create", compact("periodeAktif"));
    }

    public function editBarang()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("Admin.Master-Barang.edit", compact("periodeAktif"));
    }
}
