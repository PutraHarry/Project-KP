<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    protected $table = 'tb_master_kegiatan';

    public function program()
    {
        return $this->belongsTo(ProgramModel::class, 'id_program', 'id');
    }
    
    public function penerimaan()
    {
        return $this->hasMany(PenerimaanModel::class, 'id_m_kegiatan', 'id');
    }
}
