<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolsKaryawan extends Model
{
    protected $table = "tools_karyawan";

    public function karyawan()
    {
      return $this->belongsTo('App\Karyawan');
    }

    public function condition()
    {
      return $this->belongsTo('App\GoodsCondition', 'goods_condition_id');
    }

    public function tools()
    {
      return $this->belongsTo('App\Tools');
    }

    public function handover()
    {
      return $this->belongsTo('App\AllhoActivities', 'allho_activities_id');
    }
}
