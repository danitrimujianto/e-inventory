<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tools extends Model
{
    use SoftDeletes;
    protected $table = "tools";
    protected $dates = ['deleted_at'];

    public function division()
    {
      return $this->belongsTo('App\Division');
    }

    public function barang()
    {
      return $this->belongsTo('App\Barang');
    }
}
