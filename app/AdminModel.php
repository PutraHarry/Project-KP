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
}