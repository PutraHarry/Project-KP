<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodeModel;

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
}
