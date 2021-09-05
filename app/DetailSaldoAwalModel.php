<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
