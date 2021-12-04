<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaanModel extends Model
{
    protected $table = 'tb_penggunaan';

    public function gudangOPD() {
        return $this->belongsTo(GudangOPDModel::class,'id_gudang_opd','id');
    }

    public function gudangUnit() {
        return $this->belongsTo(GudangUnitModel::class,'id_gudang_unit','id');
    }
}

