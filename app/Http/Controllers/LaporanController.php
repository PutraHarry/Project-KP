<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BarangModel;
use App\BarangOPDModel;
use App\BarangUnitModel;
use App\DetailSaldoAwalModel;
use App\DetailPenerimaanModel;
use App\DetailPengeluaranModel;
use App\DetailOpnameModel;
use App\OPDModel;
use App\PeriodeModel;

class LaporanController extends Controller
{
    public function showLaporan()
    {
        
        return view("Admin.Laporan.show");
    }

    public function laporanOPD()
    {
        if (Auth::user()->jabatan->jabatan == 'Admin BPKAD') {
            $opd = OPDModel::get();
        } else {
            $opd = OPDModel::where('id', Auth::user()->opd->id)->get();
        }

        $periode = PeriodeModel::get();

        return view("Admin.Laporan.Persediaan.LP_dinas", compact('opd', 'periode'));
    }

    public function getTabel($idOPD, $idPeriode)
    {
        $opd = OPDModel::where('id', $idOPD)->get();
        $periode = PeriodeModel::where('id', $idPeriode)->get();

        $coba = BarangModel::get();
        $test = view('Admin.Laporan.Tabel', ['coba' => $coba, 'opd' => $opd, 'periode' => $periode])->render();

        return response()->json($test);
    }

    public function getDataSaldoAwal($id, $idOPD, $idPeriode)
    {
        $dataBarang = DetailSaldoAwalModel::where('id_barang', $id)->get();
        $jumlahBarang = $dataBarang->sum('qty');
        $totalHarga = $dataBarang->sum('harga');
        return response()->json(['jumlahBarang' => $jumlahBarang, 'dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function getDataPenerimaan($id)
    {
        $dataBarang = DetailPenerimaanModel::where('id_barang', $id)->get();
        $jumlahBarang = $dataBarang->sum('qty');
        $totalHarga = $dataBarang->sum('harga');
        return response()->json(['jumlahBarang' => $jumlahBarang, 'dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function getDataPengeluaran($id)
    {
        $dataBarang = DetailPengeluaranModel::where('id_barang', $id)->get();
        $jumlahBarang = $dataBarang->sum('qty');
        $totalHarga = $dataBarang->sum('harga');
        return response()->json(['jumlahBarang' => $jumlahBarang, 'dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }

    public function getDataBarangOPD($id)
    {
        $barang = BarangModel::find($id);
        $dataBarang = BarangOPDModel::where('id_barang', $id)->first();
        $totalHarga = $dataBarang->qty * $barang->harga_m_barang;
        return response()->json(['dataBarang' => $dataBarang, 'totalHarga' => $totalHarga]);
    }
}
