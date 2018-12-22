<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsCondition extends Model
{
    use SoftDeletes;
    protected $table = "goods_condition";
    protected $dates = ['deleted_at'];
}
