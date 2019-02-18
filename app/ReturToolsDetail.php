<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturToolsDetail extends Model
{
    protected $table = "retur_tools_detail";

    public function condition()
    {
      return $this->belongsTo('App\GoodsCondition', 'goods_condition_id');
    }

    public function tools()
    {
      return $this->belongsTo('App\Tools', 'tools_id');
    }

    public function Retur()
    {
      return $this->belongsTo('App\ReturTools', 'retur_tools_id');
    }
}
