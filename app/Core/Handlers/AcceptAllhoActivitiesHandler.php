<?php
namespace App\Core\Handlers;

use App\AllhoActivities;
use App\AllhoActivitiesDetail;
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
        $id = $this->id;
        $data = $this->saveDB($id);
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
          $detail = AllhoActivitiesDetail::where("allho_activities_id", '=', $id)->select('tools_id', 'goods_condition_id');
          // dd($detail);
          // dd($detail->toSql());
          // $detail->get();
          $getDet = $detail->get();
          $total = $getDet->count();

          $bindings = $detail->getBindings();

          $insertQuery = 'INSERT INTO tools_karyawan (allho_activities_id, accepted_date, karyawan_id,tools_id,goods_condition_id) '.$detail->toSql();
          $insertQuery = str_replace(") select ", ") select ".$tab->id.", NOW(), ".$tab->recipient_id.", ", $insertQuery);
          // dd($insertQuery);
          \DB::insert($insertQuery, $bindings);

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

          \DB::insert($delExist);
        }

        return $tab;
    }
}
