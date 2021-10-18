<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DetailSaldoAwalModel extends Model
{
    protected $table = 'tb_d_saldo';

    protected $fillable = [
        'id_saldo',
        'id_barang',
        'qty',
        'harga',
        'keterangan',
    ];

    public function barang(){
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}
