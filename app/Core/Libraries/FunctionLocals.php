<?php
namespace App\Core\Libraries;

use Illuminate\Support\Facades\DB;


class FunctionLocals {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function checkStatusAllHo($obj, $type) {
    	if($obj == "0"){
    		$ret = '<span class="badge bg-grey">Pending</span>';
    	}elseif($obj == "1"){
        if($type == "office"){
      		  $ret = '<span class="badge bg-grey">Pending</span>';
        }else{
        $ret = '<span class="badge bg-green">Admin Approved</span>';
        }
    	}elseif($obj == "2"){
      $ret = '<span class="badge bg-green">Accepted</span>';
    	}elseif($obj == "98"){
    		$ret = '<span class="badge bg-red">Canceled</span>';
    	}elseif($obj == "99"){
    		$ret = '<span class="badge bg-red">Rejected</span>';
    	}

    	return $ret;
    }

    public static function checkAdminStatus($obj, $type){
      $ret = "";
      if($obj >= 1){
        if($type == "office"){
            $ret = '<span class="badge bg-grey">Pending</span>';
        }else{
          if($obj == 2){
            $ret = '<span class="badge bg-green">Admin Approved</span>';
          }else{
            $ret = '<span class="badge bg-red">Rejected</span>';
          }
        }
      }

      return $ret;
    }

    public static function checkPurchaseRequest($obj, $type) {
     if($obj == "0"){
       $ret = '<span class="badge bg-grey">Pending</span>';
     }elseif($obj == "1"){
       $ret = '<span class="badge bg-green">Manager Approved</span>';
     }elseif($obj == "2"){
       $ret = '<span class="badge bg-green">Accepted</span>';
     }elseif($obj == "98"){
       $ret = '<span class="badge bg-red">Canceled</span>';
     }elseif($obj == "99"){
       $ret = '<span class="badge bg-red">Rejected</span>';
     }

     return $ret;
    }

    public static function checkRecipient($obj) {
      $ret = "";
     if(!empty($obj)){
       $ret = '<span class="badge bg-green">Accepted</span>';
     }

     return $ret;
    }
}
