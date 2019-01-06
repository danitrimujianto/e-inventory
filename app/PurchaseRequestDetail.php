<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestDetail extends Model
{
    protected $table = "purchase_request_detail";

    public function purchase_request()
    {
      return $this->belongsTo('App\PurchaseRequest', 'purchase_request_id');
    }
    
}
