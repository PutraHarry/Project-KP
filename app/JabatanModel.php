<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JabatanModel extends Model
{
    protected $table = 'tb_jabatan';

    public function admin()
    {
        return $this->hasMany(AdminModel::class, 'id_jabatan', 'id');
    }
}
