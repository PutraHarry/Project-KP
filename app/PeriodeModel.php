<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PeriodeModel extends Model
{
    protected $table = 'tb_periode';

    public function opd()
    {
        return $this->belongsTo(OPDModel::class, 'id_opd', 'id');
    }
}
