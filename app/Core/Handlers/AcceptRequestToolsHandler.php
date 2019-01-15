<?php
namespace App\Core\Handlers;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\EmailExternal;
use App\AllhoActivitiesDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;
use Notifiable;

class AcceptRequestToolsHandler implements Handler
{
    private $request;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $id = $this->id;
        $data = $this->saveDB($id);
        $detail = $this->getPurchaseDetail($data->id);
        $sendmail = $this->notifFinance($data, $detail);
        return $data;
    }

    private function saveDB($id)
    {
        $usertype = Auth::user()->usertype_id;

        $tab = PurchaseRequest::find($id);
        $tab->approved_date = date("Y-m-d H:i:s");
        $tab->approved_by = Auth::user()->karyawan_id;
        $tab->status = "1";
        $tab->save();

        return $tab;
    }

    private function getPurchaseDetail($id){
      $data = PurchaseRequestDetail::where('purchase_request_id', $id)->get();

      return $data;
    }

    private function notifFinance($data, $detail)
    {
      $returnData['data'] = $data;
      $returnData['detail'] = $detail;
      $user = EmailExternal::where('type', 'Finance')->get();

      $emails = array();
      foreach($user AS $val){
        $sendmail = $val->NotifPurchase($returnData, $val->email);
      }
    }
}
