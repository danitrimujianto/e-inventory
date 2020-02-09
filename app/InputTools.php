<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputTools extends Model
{
    use SoftDeletes;
    protected $table = "input_tools";
    protected $dates = ['deleted_at'];

    public function division()
    {
      return $this->belongsTo('App\Division');
    }

    public function barang()
    {
      return $this->belongsTo('App\Barang');
    }

    public function supplier()
    {
      return $this->belongsTo('App\Supplier');
    }
}
