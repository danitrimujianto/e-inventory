<?php
namespace App\Core\Handlers;

use App\AllhoActivities;
use App\AllhoActivitiesDetail;
use App\ToolsKaryawan;
use App\User;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AcceptAllhoActivitiesHandler implements Handler
{
    private $request;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $usertype = Auth::user()->usertype_id;
        $id = $this->id;
        $data = $this->saveDB($id);
        if($usertype == "2"){
          $notif = $this->sendnotif($data, $data->recipient_id);
        }else if($usertype == "4" || $usertype == "5"){
          $notif = $this->sendnotif($data, $data->sender_id);
        }
        return $data;
    }

    private function saveDB($id)
    {
        $usertype = Auth::user()->usertype_id;

        $tab = AllhoActivities::find($id);
        if($usertype == "2"){
          $tab->approved_date = date("Y-m-d H:i:s");
          $tab->status = "1";
        }elseif($usertype == "4" || $usertype == "5"){
          $tab->accepted_date = date("Y-m-d H:i:s");
          $tab->status = "2";
        }
        $tab->save();


        if($usertype == "4" || $usertype == "5")
        {
          $tools_sender = ToolsKaryawan::where('karyawan_id', $tab->sender_id)->get();
          $detail = AllhoActivitiesDetail::where("allho_activities_id", '=', $id)->select('tools_id', 'goods_condition_id');

          $getDet = $detail->get();
          $total = $getDet->count();

          $bindings = $detail->getBindings();

          $insertQuery = 'INSERT INTO tools_karyawan (allho_activities_id, accepted_date, karyawan_id,tools_id,goods_condition_id) '.$detail->toSql();
          $insertQuery = str_replace(") select ", ") select ".$tab->id.", NOW(), ".$tab->recipient_id.", ", $insertQuery);


          $updet = 'UPDATE tools SET karyawan_id = CASE id ';
          $delExist = 'DELETE FROM tools_karyawan WHERE (karyawan_id, tools_id) IN ';

          $idUpdate = "";
          $idExist = "";
          $counter = 0;
          foreach($getDet AS $det){
            $counter++;
            $updet .= ' WHEN '.$det['tools_id'].' THEN "'.$tab->recipient_id.'"';
            $idUpdate .= $det['tools_id']. ($counter < $total ? "," : "");
            $idExist .= '('.$tab->sender_id.', '.$det['tools_id'].')'. ($counter < $total ? "," : "");
          }

          $updet .= " END WHERE id IN(".$idUpdate.")";
          \DB::insert($updet);

          $delExist .= '('.$idExist.')';
          // dd($delExist);
          if($tab->type == 'user')
          {
            if($tools_sender->count() > 0)
            {  $delop = \DB::statement($delExist); }
            \DB::insert($insertQuery, $bindings);
          }
        }

        return $tab;
    }

    private function sendnotif($data, $target)
    {
      $id = $data->id;
      $usertype = Auth::user()->usertype_id;
      $detailData = AllhoActivitiesDetail::where('allho_activities_id', $id)->get();

      $returnData['data'] = $data;
      $returnData['detail'] = $detailData;
      if($usertype == "2"){
        $returnData['target'] = 'reciever';
      }elseif($usertype == "4" || $usertype == "5"){
        $returnData['target'] = 'sender';
      }
      $user = User::where('karyawan_id', $target)->get();

      $emails = array();
      foreach($user AS $val){
        $sendmail = $val->NotifHandover($returnData, $val->email);
      }
    }
}
