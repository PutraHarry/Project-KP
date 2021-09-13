<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodeModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dashboard()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("dashboard", compact("periodeAktif"));
    }
}
