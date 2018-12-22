<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $table = "project";
    protected $dates = ['deleted_at'];

    public function area()
    {
      return $this->belongsTo('App\Area');
    }

    public function city()
    {
      return $this->belongsTo('App\City');
    }

    public function vendor()
    {
      return $this->belongsTo('App\Vendor');
    }
}
