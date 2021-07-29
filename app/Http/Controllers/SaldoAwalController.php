<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaldoAwalModel;
use Illuminate\Support\Facades\Validator;
use DB;

class SaldoAwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataSaldoAwal()
    {
        $tsaldo = SaldoAwalModel::get();

        return view("Admin.Saldo.show", compact("tsaldo"));
    }

    public function addSaldoAwal()
    {
        return view("Admin.Saldo.create");
    }
}
