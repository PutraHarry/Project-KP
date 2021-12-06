<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramModel extends Model
{
    protected $table = 'tb_master_program';

    public function kegiatan()
    {
        return $this->hasMany(KegiatanModel::class, 'id_program', 'id');
    }

    public function penerimaan()
    {
        return $this->hasMany(PenerimaanModel::class, 'id_m_program', 'id');
    }
}
