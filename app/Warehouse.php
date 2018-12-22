<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    protected $table = "warehouse";
    protected $dates = ['deleted_at'];

    public function area()
    {
      return $this->belongsTo('App\Area');
    }

    public function city()
    {
      return $this->belongsTo('App\City');
    }
}
