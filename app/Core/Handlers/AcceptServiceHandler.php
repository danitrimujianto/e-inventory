<?php
namespace App\Core\Handlers;

use App\Service;
use App\User;
use App\Karyawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AcceptServiceHandler implements Handler
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
        $notif = $this->sendnotif($data);
        $notifFinance = $this->sendnotifFinance($data);
        return $data;
    }

    private function saveDB($id)
    {
        $usertype = Auth::user()->usertype_id;
        $karyawan_id = Auth::user()->karyawan_id;

        $tab = Service::find($id);
        $tab->accepted_date = date("Y-m-d H:i:s");
        $tab->accepted_by = $karyawan_id;
        $tab->status = "1";
        $tab->save();

        return $tab;
    }

    private function sendnotif($data)
    {
      $returnData['data'] = $data;
      $returnData['target'] = $data->karyawan_id;
      $user = User::where('karyawan_id', $returnData['target'])->get();

      $emails = array();
      foreach($user AS $val){
        $sendmail = $val->NotifService($returnData, $val->email);
      }
    }

    private function sendnotifFinance($data)
    {
      $returnData['data'] = $data;
      $returnData['target'] = '6';
      $user = User::where('usertype_id', $returnData['target'])->get();

      $emails = array();
      foreach($user AS $val){
        $sendmail = $val->NotifService($returnData, $val->email);
      }
    }
}
