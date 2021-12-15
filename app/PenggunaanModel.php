<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaanModel extends Model
{
    protected $table = 'tb_penggunaan';

    public function opd() {
        return $this->belongsTo(OPDModel::class,'id_opd','id');
    }

    public function unit() {
        return $this->belongsTo(UnitModel::class,'id_unit','id');
    }

    public function penerimaan() {
        return $this->belongsTo(PenerimaanModel::class,'id_penerimaan','id');
    }
}

