<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    use SoftDeletes;
    protected $table = "tb_test";
}
