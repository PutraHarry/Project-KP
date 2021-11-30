<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BarangUnitModel extends Model
{
    protected $table = 'tb_barang_unit';

    public function gudang()
    {
        return $this->belongsTo(GudangUnitModel::class, 'id_gudang', 'id');
    }
    
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id');
    }
}
