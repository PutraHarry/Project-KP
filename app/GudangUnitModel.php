<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GudangUnitModel extends Model
{
    protected $table = 'tb_unit_gudang';

    public function unit()
    {
        return $this->belongsTo(UnitModel::class, 'id_unit', 'id');
    }
    
    public function barangUnit()
    {
        return $this->hasOne(BarangUnitModel::class, 'id_unit', 'id');
    }
}
