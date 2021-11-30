<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPemusnahanModel extends Model
{
    protected $table = 'tb_d_pemusnahan';

    public function barang(){
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}
