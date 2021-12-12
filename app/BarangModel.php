<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BarangModel extends Model
{
    protected $table = 'tb_master_barang';

    public function barangOPD()
    {
        return $this->hasMany(BarangOPDModel::class, 'id_barang', 'id');
    }

    public function detailSaldoAwal()
    {
        return $this->hasMany(DetailSaldoAwal::class, 'id_barang', 'id');
    }

    public function detailPenerimaan()
    {
        return $this->hasMany(DetailPenerimaanModel::class, 'id_barang', 'id');
    }

    public function detailPengeluaran()
    {
        return $this->hasMany(DetailPengeluaranModel::class, 'id_barang', 'id');
    }

    public function detailOpname()
    {
        return $this->hasMany(DetailOpnamePengeluaran::class, 'id_barang', 'id');
    }
}