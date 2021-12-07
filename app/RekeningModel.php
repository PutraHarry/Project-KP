<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekeningModel extends Model
{
    protected $table = 'tb_rekening';

    public function penerimaan()
    {
        return $this->hasMany(PenerimaanModel::class, 'id_rekening', 'id');
    }
}
