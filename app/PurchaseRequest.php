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
}
