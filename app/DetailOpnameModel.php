<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOpnameModel extends Model
{
    protected $table = 'tb_d_opname';

    public function barang(){
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}
