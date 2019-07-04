<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequest extends Model
{
    use SoftDeletes;
    protected $table = "purchase_request";
    protected $dates = ['deleted_at'];

    public function karyawan()
    {
      return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }

    public function acc_by()
    {
      return $this->belongsTo('App\Karyawan', 'approved_by');
    }

    public function reject_by()
    {
      return $this->belongsTo('App\Karyawan', 'rejected_by', 'id');
    }

    public function purchase_detail()
    {
      return $this->hasMany('App\PurchaseRequestDetail', 'purchase_request_id');
    }

    public function project()
    {
      return $this->belongsTo('App\Project', 'project_id');
    }

    public function _callFinanceStatus($obj){
      $res = '';
      if($obj == "0"){
        $res = '<span class="badge bg-grey">Pending</span>';
      }elseif($obj == "1"){
        $res = '<span class="badge bg-green">Outstanding</span>';
      }elseif($obj == "2"){
        $res = '<span class="badge bg-green">Accepted</span>';
      }elseif($obj == "3"){
        $res = '<span class="badge bg-green">Approved</span>';
      }elseif($obj == "98"){
        $res = '<span class="badge bg-red">Canceled</span>';
      }elseif($obj == "99"){
        $res = '<span class="badge bg-red">Rejected</span>';
      }

      return $res;
    }

    public function _checkReadyItem(){
      $re = true;
      $total = $this->purchase_detail()->count();
      $jml = $this->purchase_detail()->whereRaw('jml_input >= quantity')->count();
      if($jml == $total){
          $re = false;
      }else{
          $re = true;
      }
      return $re;
    }
}
