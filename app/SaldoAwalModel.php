<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaldoAwalModel extends Model
{
    protected $table = 'tb_saldo_awal';

    public function detailsaldo()
    {
        return $this->hasMany(DetailSaldoAwalModel::class, 'id_saldo', 'id');
    }
}
