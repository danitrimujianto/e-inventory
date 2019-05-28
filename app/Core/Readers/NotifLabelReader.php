<?php
namespace App\Core\Readers;

use App\ToolsKaryawan;
use App\AllhoActivities;
use App\ReturTools;
use App\PurchaseRequest;
use App\Service;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class NotifLabelReader implements Reader
{
    private $usertype;
    /** constructor, fungsinya untuk memudahkan passing variable dari controller */
    public function __construct()
    {
        $this->usertype = Auth::user()->usertype_id;
        $this->userid = Auth::user()->karyawan_id;
    }

    /** method ini digunakan untuk mengeksekusi query */
    public function read()
    {
    }

    public function getPendingWarehouse(){
      $status = "1";

      $data = AllhoActivities::where('status', $status)->where('type', 'office')->whereNull('deleted_at')->count();

      return $data;
    }

    public function getPendingSubmission(){
      $status1 = "";
      $status2 = "";
      if($this->usertype == 2){
        $status1 = "0";
        $status2 = "0";
      }else if($this->usertype == 4){
        $status1 = "0";
        $status2 = "1";
      }

      $data = AllhoActivities::where('type', 'user')->where('sender_id', $this->userid)->whereBetween('status', array($status1, $status2))->whereNull('deleted_at')->count();

      return $data;
    }

    public function getPendingAcceptance(){
      $status1 = "";
      $status2 = "";
      if($this->usertype == 2){
        $status1 = "0";
        $status2 = "0";
        $type = "";
      }else if($this->usertype == 4){
        $status1 = "0";
        $status2 = "1";
      }

      $data = AllhoActivities::whereBetween('status', array($status1, $status2))->whereNull('deleted_at');
      if($this->usertype == 4){
        $data = $data->where('recipient_id', $this->userid);
      }
      $data = $data->count();
      return $data;
    }

    public function getPendingRetur(){
      $status1 = "0";

      $data = ReturTools::where('status', $status1)->whereNull('deleted_at');
      if($this->usertype == "4"){
        $data = $data->where('karyawan_id', $this->userid);
      }
      $data = $data->count();

      return $data;
    }

    public function getPendingRequestTools(){
      $status = "";
      $opr = "";
      if($this->usertype == 3){
        $status = "0";
        $opr = "=";
      }else {
        $status = "1";
        $opr = "<=";
      }

      $data = PurchaseRequest::where('status', $opr, $status)->whereNull('deleted_at')->count();

      return $data;
    }

    public function getPendingMaintenance(){
      // $status = "0";

      $data = Service::whereNull('status')->whereNull('deleted_at')->count();

      return $data;
    }
}
