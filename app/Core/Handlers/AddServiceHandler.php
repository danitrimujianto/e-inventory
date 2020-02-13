<?php
namespace App\Core\Handlers;

use App\Service;
use App\ServiceDetail;
use App\User;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddServiceHandler implements Handler
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $request = $this->request;
        $data = $this->saveDB($request);
        $notif = $this->sendnotif($data);

        return $data;
    }

    private function saveDB($request)
    {
        $path = "";
        $usertype = Auth::user()->usertype_id;

        $karyawan_id = Auth::user()->karyawan_id;

        $tab = new Service();
        $tab->tanggal = HelpMe::tgl_indo_to_sql($request->tanggal);
        $tab->start_date = HelpMe::tgl_indo_to_sql($request->start_date);
        $tab->remarks = $request->remarks;
        $tab->karyawan_id = $karyawan_id;
        $tab->save();

        foreach($request->idTools AS $k=>$v){
          $model = new ServiceDetail;
          $model->service_id = $tab->id;
          $model->tools_id = $v;
          $model->price = HelpMe::nominalSql2($request->price[$k]);
          $model->condition_id = $request->goods_condition_id[$k];
          $model->problem = $request->problem[$k];
          $model->save();
        }

        return $tab;
    }

    private function kode()
    {
      $prefix = "OG";
      $bln = (strlen(date('m')) == 1 ? '0'.date('m') : date('m'));
      $thn = date('Y');

      $data = AllhoActivities::whereMonth('tgl', $bln)->whereYear('tgl', $thn)->orderBy('id', 'desc')->first();
      $new_no = (substr($data["outgoing_no"], 6, 5)+1);

      if(strlen($new_no) == 1)
      { $new_no = "0000".$new_no; }
      else if(strlen($new_no) == 2)
      { $new_no = "000".$new_no; }
      else if(strlen($new_no) == 3)
      { $new_no = "00".$new_no; }
      else if(strlen($new_no) == 4)
      { $new_no = "0".$new_no; }
      else if(strlen($new_no) == 5)
      { $new_no = $new_no; }

      $new_no = $prefix.substr($thn, 2, 2).$bln.$new_no;
      return $new_no;
    }

    private function sendnotif($data)
    {
      $returnData['data'] = $data;
      $returnData['target'] = "3";
      $user = User::where('usertype_id', 3)->get();

      $emails = array();
      foreach($user AS $val){
        $sendmail = $val->NotifService($returnData, $val->email);
      }
    }
}
