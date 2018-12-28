<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllhoActivitiesDetail extends Model
{
  protected $table = "allho_activities_detail";

  public function allhoactivities()
  {
    return $this->belongsTo('App\AllhoActivities', 'allho_activities_id');
  }

  public function tools()
  {
    return $this->belongsTo('App\Tools', 'tools_id');
  }

  public function condition()
  {
    return $this->belongsTo('App\GoodsCondition', 'goods_condition_id');
  }
}
