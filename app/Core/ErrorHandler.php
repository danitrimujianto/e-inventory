<?php
namespace App\Core;

use Illuminate\Http\Request;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class ErrorHandler extends ExceptionHandler
{
  public function process($status)
  {

    $alert = '<div class="alert alert-'.$status['status'].' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa "></i> '.$status['msg'].'</h4></div>';
    return $alert;
  }

  public function statusIcon($status)
  {
    if($status == "success")
      $icon = "fa-check";
    elseif($status == "failed")
      $icon = "fa-remove";

    return $icon;
  }
}
