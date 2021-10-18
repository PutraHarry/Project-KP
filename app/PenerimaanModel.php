<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PenerimaanModel extends Model
{
    protected $table = 'tb_penerimaan';

    public function penerimaan()
    {
        return $this->hasMany(DetailPenerimaanAwalModel::class, 'id_penerimaan', 'id');
    }
}
