<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    protected $table = 'tb_user';

    protected $guard = 'admin';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function unit()
    {
        return $this->belongsTo(UnitModel::class, 'id_unit', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id');
    }

    public function opd()
    {
        return $this->belongsTo(OPDModel::class, 'id_opd', 'id');
    }
}