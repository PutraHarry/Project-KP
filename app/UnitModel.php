<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class unitModel extends Model
{
    protected $table = 'tb_unit';

    public function opd()
    {
        return $this->belongsto(OPDModel::class, 'id_opd', 'id');
    }

    public function admin()
    {
        return $this->hasMany(AdminModel::class, 'id_unit', 'id');
    }

    public function gudangUnit()
    {
        return $this->hasOne(GudangUnitModel::class, 'id_unit', 'id');
    }

    public function penggunaan() 
    {
        return $this->hasMany(GudangUnitModel::class, 'id_gudang_unit', 'id');
    }
}
