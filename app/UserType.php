<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
  use SoftDeletes;
  protected $table = "usertype";
  protected $dates = ['deleted_at'];
}
