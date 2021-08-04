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
        $tpenerimaanobat = PenerimaanModel::where('id_jenis_penerimaan', '1')->get();
        $tpenerimaannonobat = PenerimaanModel::where('id_jenis_penerimaan', '2')->get();
        $tpenerimaanhibah = PenerimaanModel::where('id_jenis_penerimaan', '3')->get();
        $tpenerimaannonhibah = PenerimaanModel::where('id_jenis_penerimaan', '4')->get();
        $tpenerimaannonapbd = PenerimaanModel::where('id_jenis_penerimaan', '5')->get();
        

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
