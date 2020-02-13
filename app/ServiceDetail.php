<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    protected $table = "service_detail";

    public function tools()
    {
      return $this->belongsTo('App\Tools', 'tools_id');
    }

    public function condition()
    {
      return $this->belongsTo('App\GoodsCondition', 'condition_id');
    }

    public function after()
    {
      return $this->belongsTo('App\GoodsCondition', 'after_id');
    }

    public function service()
    {
      return $this->belongsTo('App\Service', 'service_id');
    }

}
