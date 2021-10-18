<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DetailPenerimaanModel extends Model
{
    protected $table = 'tb_d_penerimaan';

    public function barang(){
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}
