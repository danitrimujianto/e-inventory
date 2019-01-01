<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;
    protected $table = "karyawan";
    protected $dates = ['deleted_at'];

    public function departemen()
    {
      return $this->belongsTo('App\Departemen');
    }

    public function position()
    {
      return $this->belongsTo('App\Position');
    }

    public function project()
    {
      return $this->belongsTo('App\Project');
    }

    public function homebasearea()
    {
      return $this->belongsTo('App\Area', 'homebasearea_id');
    }

    public function assignmentarea()
    {
      return $this->belongsTo('App\City', 'assignmentarea_id');
    }
}
