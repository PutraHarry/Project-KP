<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\PeriodeModel;
use App\BarangModel;
use App\JenisBarangModel;


class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function dataBarang()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $barang = BarangModel::get();
        
        return view("Admin.Master-Barang.show", compact("periodeAktif", "barang"));
    }

    public function createBarang()
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $jenisBarang = JenisBarangModel::get();
        
        return view("Admin.Master-Barang.create", compact("periodeAktif", "jenisBarang"));
    }

    public function insertBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $barang = new BarangModel();
        $barang->nama_m_barang = $request->nama_barang;
        $barang->id_jenis = $request->jenis_barang;
        $barang->satuan_m_barang = $request->satuan;
        $barang->harga_m_barang = $request->harga;
        $barang->save();
        
        
        return redirect()->route('barang')->with('statusInput', 'Insert Success');
    }

    public function editBarang($id)
    {
        $dataPeriodeAktif = PeriodeModel::whereIn('id_opd', [Auth::user()->opd->id])->whereIn('status_periode', ['open'])->first();
        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $idEdit = $id;
        $dataBarang = BarangModel::find($id);
        $jenisBarang = JenisBarangModel::get();
        
        return view("Admin.Master-Barang.edit", compact("periodeAktif", "dataBarang", "jenisBarang", "idEdit"));
    }

    public function updateBarang($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
            
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $barang = BarangModel::find($id);
        $barang->nama_m_barang = $request->nama_barang;
        $barang->id_jenis = $request->jenis_barang;
        $barang->satuan_m_barang = $request->satuan;
        $barang->harga_m_barang = $request->harga;
        $barang->update();
        
        
        return redirect()->route('barang')->with('statusInput', 'update Success');
    }

    public function deleteBarang($id)
    {
        $barang = BarangModel::find($id);
        $barang->delete();
        
        return redirect('/barang')->with('statusInput', 'Delete Success');
    }
}
