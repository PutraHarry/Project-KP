<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\AdminModel;
use App\PeriodeModel;
use App\JabatanModel;
use App\OPDModel;
use App\UnitModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dashboard()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        
        return view("dashboard", compact("periodeAktif"));
    }

    public function dataUser()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
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
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $dataOPD = OPDModel::get();
        //dd($dataOPD);

        $jabatan = JabatanModel::get();
        
        return view("Admin.Tambah-User.create", compact("periodeAktif", 'dataOPD', 'jabatan'));
    }

    public function insertUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nama_user' => 'required',
            'dob' => 'required',
            'id_opd' => 'required',
            'id_unit' => 'required',
            'id_jabatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if($request->password != $request->confirm_password) {
            return back()->withErrors('ga sama');
        }

        $password = Hash::make($request->password);

        $user = new AdminModel();
        $user->username = $request->username;
        $user->password = $password;
        $user->nama_user = $request->nama_user;
        $user->dob = $request->dob;
        $user->id_opd = $request->id_opd;
        $user->id_unit = $request->id_unit;
        $user->id_jabatan = $request->id_jabatan;
        $user->save();
        
        
        return redirect()->route('user')->with('statusInput', 'Insert Success');
    }

    public function editUser($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }

        $user = AdminModel::find($id);
        $dataOPD = OPDModel::get();
        $jabatan = JabatanModel::get();
        
        return view("Admin.Tambah-User.edit", compact("periodeAktif", 'user', 'dataOPD', 'jabatan'));
    }

    public function updateUser($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'nama_user' => 'required',
            'dob' => 'required',
            'id_opd' => 'required',
            'id_unit' => 'required',
            'id_jabatan' => 'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if($request->password != $request->confirm_password) {
            return back()->withErrors('ga sama');
        }

        $password = Hash::make($request->password);

        $user = AdminModel::find($id);
        $user->username = $request->username;
        $user->password = $password;
        $user->nama_user = $request->nama_user;
        $user->dob = $request->dob;
        $user->id_opd = $request->id_opd;
        $user->id_unit = $request->id_unit;
        $user->id_jabatan = $request->id_jabatan;
        $user->update();
        
        
        return redirect()->route('user')->with('statusInput', 'Update Success');
    }

    public function deleteUser($id)
    {
        $user = AdminModel::find($id);
        $user->delete();
        
        return redirect('/user')->with('statusInput', 'Delete Success');
    }

    public function getDataUnit($id)
    {
        $dataUnit = UnitModel::where('id_opd',$id)->get();

        return response()->json($dataUnit);
    }
}
