<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OPDModel extends Model
{
    protected $table = 'tb_opd';

    public function unit()
    {
        return $this->hasMany(UnitModel::class, 'id_opd', 'id_opd');
    }
    
    public function admin()
    {
        return $this->hasMany(AdminModel::class, 'id_opd', 'id');
    }
}
