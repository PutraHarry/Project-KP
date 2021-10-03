<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DetailPenggunaanModel extends Model
{
    protected $table = 'tb_d_penggunaan';

    public function barang(){
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}
