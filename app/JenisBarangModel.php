<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBarangModel extends Model
{
    protected $table = 'tb_jenis_barang';

    public function barang()
    {
        return $this->hasMany(Barangmodel::class, 'id_jenis', 'id');
    }
}
