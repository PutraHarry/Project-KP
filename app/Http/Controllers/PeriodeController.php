<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< Updated upstream

class PeriodeController extends Controller
{
    //
=======
use App\PeriodeModel;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataPeriode()
    {
        $periodes = PeriodeModel::get();

        $tperiode = PeriodeModel::orderby('created_at', 'desc')->get();

        return view("Admin.Periode.show", compact('tperiode', 'periodes'));
    }

    public function addPeriode()
    {
        return view('Admin.Periode.create');
    }

    public function insertPeriode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_opd' => 'required',
            'nama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        return redirect('/periode')->with('StatusInput', 'Input Success');
    }
>>>>>>> Stashed changes
}
