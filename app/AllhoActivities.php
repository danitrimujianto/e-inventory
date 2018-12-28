<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllhoActivities extends Model
{
    use SoftDeletes;
    protected $table = "allho_activities";
    protected $dates = ['deleted_at'];

    public function delivery()
    {
      return $this->belongsTo('App\Delivery', 'delivery_id');
    }

    public function goodscondition()
    {
      return $this->belongsTo('App\GoodsCondition', 'goods_condition_id');
    }

    public function project()
    {
      return $this->belongsTo('App\Project', 'project_id');
    }

    public function sender()
    {
      return $this->belongsTo('App\Karyawan', 'sender_id');
    }

    public function karyawan()
    {
      return $this->belongsTo('App\Karyawan', 'recipient_id');
    }

    public function fromarea()
    {
      return $this->belongsTo('App\Area', 'fromarea_id');
    }

    public function toarea()
    {
      return $this->belongsTo('App\Area', 'toarea_id');
    }

    public function AllhoDetail()
    {
      return $this->hasMany('App\AllhoActivitiesDetail', 'allho_activities_id');
    }
}
