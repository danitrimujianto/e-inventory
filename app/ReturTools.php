<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturTools extends Model
{
    use SoftDeletes;
    protected $table = "retur_tools";
    protected $dates = ['deleted_at'];


    public function karyawan()
    {
      return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }

    public function acceptBy()
    {
      return $this->belongsTo('App\Karyawan', 'accepted_by');
    }

    public function project()
    {
      return $this->belongsTo('App\Project', 'project_id');
    }

    public function delivery()
    {
      return $this->belongsTo('App\Delivery', 'delivery_id');
    }

    public function ReturDetail()
    {
      return $this->hasMany('App\ReturToolsDetail', 'retur_tools_id');
    }
}
