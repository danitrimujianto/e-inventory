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

    public function ServiceDetail()
    {
      return $this->hasMany('App\ServiceDetail', 'service_id');
    }

    public function status(){
      if(empty($this->status) || $this->status == '0'){
        return '<span class="badge bg-default">Pending</span>';
      }else if($this->status == '1'){
        return '<span class="badge bg-green">Approved</span>';
      }else if($this->status == '99'){
        return '<span class="badge bg-red">Rejected</span>';
      }else if($this->status == '2'){
        return '<span class="badge bg-blue disabled">Finish</span>';
      }
    }
}
