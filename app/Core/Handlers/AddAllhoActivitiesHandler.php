<?php
namespace App\Core\Handlers;

use App\AllhoActivities;
use App\AllhoActivitiesDetail;
use App\User;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddAllhoActivitiesHandler implements Handler
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
        $detail = $this->getHandoverDetail($data->id);
        if($data->type == 'user'){ $sendnotif = $this->sendnotif($data, $detail); }
        else if($data->type == 'office'){ $sendnotif = $this->sendnotif($data, $detail); }

        return $data;
    }

    private function saveDB($request)
    {
        $path = "";
        $usertype = Auth::user()->usertype_id;

        $sender = ($usertype != 1 ? Auth::user()->karyawan_id : $request->sender_id);
        $status = (($usertype == 2 || $usertype == 1) ? "1" : "0");
        $type = (($usertype == 2 || $usertype == 1) ? "office" : "user");
        if(!empty($request->sender_id)){ $type = "user"; }
        $kode = $this->kode();

        $tab = new AllhoActivities();
        $tab->tgl = HelpMe::tgl_indo_to_sql($request->tgl);
        $tab->delivery_id = $request->delivery_id;
        // $tab->goods_condition_id = $request->goods_condition_id;
        // $tab->fromarea_id = $request->fromarea_id;
        // $tab->toarea_id = $request->toarea_id;
        $tab->recipient_id = $request->recipient_id;
        $tab->project_id = $request->project_id;
        $tab->fromcity_id = $request->fromcity_id;
        $tab->tocity_id = $request->tocity_id;
        $tab->outgoing_no = $kode;
        $tab->receipt_no = $request->receipt_no;
        $tab->sender_id = $sender;
        $tab->type = $type;
        $tab->status = $status;
        $tab->remarks = $request->remarks;
        $tab->save();

        $tools = array();
        $isTool = false;
        $no=0;
        foreach($request->idTools AS $idTool){
          if(!empty($idTool)){
            $tools[] = array('allho_activities_id'=>$tab->id, 'tools_id'=>$idTool, 'goods_condition_id'=>$request->goods_condition_id[$no]);
            $isTool = true;
          }
          $no++;
        }

        if($isTool) $bulkTools = AllhoActivitiesDetail::insert($tools);
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
      if(strlen($new_no) == 2)
      { $new_no = "000".$new_no; }
      if(strlen($new_no) == 3)
      { $new_no = "00".$new_no; }
      if(strlen($new_no) == 4)
      { $new_no = "0".$new_no; }
      if(strlen($new_no) == 5)
      { $new_no = $new_no; }

      $new_no = $prefix.substr($thn, 2, 2).$bln.$new_no;
      return $new_no;
    }

    private function sendnotif($data, $detail)
    {
      $returnData['data'] = $data;
      $returnData['detail'] = $detail;
      $user = User::where('usertype_id', 2)->get();

      $emails = array();
      foreach($user AS $val){
        $sendmail = $val->NotifHandover($returnData, $val->email);
      }
    }

    private function getHandoverDetail($id){
      $data = AllhoActivitiesDetail::where('allho_activities_id', $id)->get();
      return $data;
    }
}
