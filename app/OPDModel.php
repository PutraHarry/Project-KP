<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OPDModel extends Model
{
    protected $table = 'tb_opd';

    public function unit()
    {
        return $this->hasMany(UnitModel::class, 'id_opd', 'id');
    }
    
    public function admin()
    {
        return $this->hasMany(AdminModel::class, 'id_opd', 'id');
    }

    public function periode()
    {
        return $this->hasMany(Periode::class, 'id_opd', 'id');
    }

    public function gudangOPD()
    {
        return $this->hasOne(GudangOPDModel::class, 'id_opd', 'id');
    }
}
