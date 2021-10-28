<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PeriodeModel;
use App\BarangModel;

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
        
        $barangKIBA = BarangModel::where('jenis_m_barang','KIB A')->get();
        $barangKIBB = BarangModel::where('jenis_m_barang','KIB B')->get();
        $barangKIBC = BarangModel::where('jenis_m_barang','KIB C')->get();
        $barangKIBD = BarangModel::where('jenis_m_barang','KIB D')->get();
        $barangKIBE = BarangModel::where('jenis_m_barang','KIB E')->get();
        $barangKIBF = BarangModel::where('jenis_m_barang','KIB F')->get();
        
        return view("Admin.Master-Barang.show", compact("periodeAktif", "barangKIBA", "barangKIBB", "barangKIBC", "barangKIBD", "barangKIBE", "barangKIBF"));
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
        
        $jenisBarang = ['KIB A', 'KIB B', 'KIB C', 'KIB D', 'KIB E', 'KIB F'];
        
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
        $barang->jenis_m_barang = $request->jenis_barang;
        $barang->satuan_m_barang = $request->satuan;
        $barang->harga_m_barang = $request->harga;
        $barang->save();
        
        
        return redirect()->route('barang')->with('statusInput', 'Insert Success');
    }

    public function editBarang($id)
    {
        $open = ['open'];
        
        $dataPeriodeAktif = PeriodeModel::whereIn('status_periode', $open)->first();

        if ($dataPeriodeAktif) {
            $periodeAktif = $dataPeriodeAktif->nama_periode;
        } else{
            $periodeAktif = "-";
        }
        
        $idEdit = $id;
        $dataBarang = BarangModel::find($id);
        $jenisBarang = ['KIB A', 'KIB B', 'KIB C', 'KIB D', 'KIB E', 'KIB F'];
        
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
        $barang->jenis_m_barang = $request->jenis_barang;
        $barang->satuan_m_barang = $request->satuan;
        $barang->harga_m_barang = $request->harga;
        $barang->update();
        
        
        return redirect()->route('barang')->with('statusInput', 'update Success');
    }
}
