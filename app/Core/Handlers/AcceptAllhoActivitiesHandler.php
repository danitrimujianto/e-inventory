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
        if($usertype == "3"){
          $tab->approved_date = date("Y-m-d H:i:s");
          $tab->status = "1";
        }elseif($usertype == "4"){
          $tab->accepted_date = date("Y-m-d H:i:s");
          $tab->status = "2";
        }
        $tab->save();


        if($usertype == "4")
        {
          $detail = AllhoActivitiesDetail::where("allho_activities_id", '=', $id)->select('tools_id', 'goods_condition_id');
          // dd($detail);
          // dd($detail->toSql());
          // $detail->get();
          $bindings = $detail->getBindings();

          $insertQuery = 'INSERT INTO tools_karyawan (accepted_date, karyawan_id,tools_id,goods_condition_id) '.$detail->toSql();
          $insertQuery = str_replace(") select ", ") select NOW(), ".$tab->recipient_id.", ", $insertQuery);
          // dd($insertQuery);
          \DB::insert($insertQuery, $bindings);

          $updet = "";
          foreach($detail->get() AS $det){
            $updet .= 'UPDATE tools SET karyawan_id = "'.$tab->recipient_id.'" WHERE id = "'.$det['tools_id'].'"';
          }
          \DB::insert($updet);
        }

        return $tab;
    }
}
