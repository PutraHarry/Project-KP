<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BarangOPDModel extends Model
{
    protected $table = 'tb_barang_opd';

    public function gudangOPD()
    {
        return $this->belongsTo(GudangOPDModel::class, 'id_gudang', 'id');
    }
    
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id');
    }
}
