<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GudangOPDModel extends Model
{
    protected $table = 'tb_opd_gudang';

    public function opd()
    {
        return $this->belongsTo(GudangUnitModel::class, 'id_opd', 'id');
    }
    
    public function barangOPD()
    {
        return $this->hasOne(BarangOPDModel::class, 'id_gudang', 'id');
    }

    public function penggunaan()
    {
        return $this->hasMany(PenggunaanModel::class,'id_gudang_opd','id');
    }
}
