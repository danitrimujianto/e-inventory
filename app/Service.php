<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    protected $table = "service";
    protected $dates = ['deleted_at'];

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

    public function karyawan()
    {
      return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }

    public function status(){
      if($this->status == '1'){
        return '<span class="badge bg-green">Approved</span>';
      }else{
        return '<span class="badge bg-default">Pending</span>';
      }
    }
}
