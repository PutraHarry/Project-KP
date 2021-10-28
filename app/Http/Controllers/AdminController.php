<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminModel;
use App\PeriodeModel;
use App\JabatanModel;
use App\OPDModel;

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

    public function dataUser()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $tuser = AdminModel::with('jabatan', 'unit', 'opd')->get();
        //dd($tuser);

        return view("Admin.Tambah-User.show", compact("periodeAktif", "tuser"));
    }

    public function createUser()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("Admin.Tambah-User.create", compact("periodeAktif"));
    }

    public function editUser()
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("Admin.Tambah-User.edit", compact("periodeAktif"));
    }
}
