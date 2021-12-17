<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PengeluaranModel extends Model
{
    protected $table = 'tb_pengeluaran';

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanModel::class, 'id_m_kegiatan', 'id');
    }
}
