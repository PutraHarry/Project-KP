<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenerimaanModel;
use App\BarangModel;
use Illuminate\Support\Facades\Validator;
use DB;

class PenerimaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataPenerimaan()
    {
        $tpenerimaanobat = PenerimaanModel::where('jenis_penerimaan', 'APBD Obat')->get();
        $tpenerimaannonobat = PenerimaanModel::where('jenis_penerimaan', 'APBD Non Obat')->get();
        $tpenerimaanhibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Obat')->get();
        $tpenerimaannonhibah = PenerimaanModel::where('jenis_penerimaan', 'Hibah Non Obat')->get();
        $tpenerimaannonapbd = PenerimaanModel::where('jenis_penerimaan', 'Non APBD')->get();
        

        return view("Admin.Penerimaan.show", compact("tpenerimaanobat","tpenerimaannonobat","tpenerimaanhibah","tpenerimaannonhibah","tpenerimaannonapbd"));
    }

    public function addPenerimaan()
    {
        return view("Admin.Penerimaan.create");
    }

    public function editPenerimaan()
    {
        return view("Admin.Penerimaan.edit");
    }
}
