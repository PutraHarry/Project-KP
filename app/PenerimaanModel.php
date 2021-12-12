<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PenerimaanModel extends Model
{
    protected $table = 'tb_penerimaan';

    protected $fillable = [
        'status_penerimaan',
    ];

    public function penerimaan()
    {
        return $this->hasMany(DetailPenerimaanModel::class, 'id_penerimaan', 'id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramModel::class, 'id_m_program', 'id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanModel::class, 'id_m_kegiatan', 'id');
    }

    public function rekening()
    {
        return $this->belongsTo(RekeningModel::class, 'id_rekening', 'id');
    }

    public function penggunaan()
    {
        return $this->hasOne(PenggunaanModel::class, 'id_penerimaan', 'id');
    }
}
