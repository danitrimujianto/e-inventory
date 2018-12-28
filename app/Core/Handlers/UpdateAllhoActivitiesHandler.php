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

class UpdateAllhoActivitiesHandler implements Handler
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
        return $data;
    }

    private function saveDB($request)
    {
        $id = $request->id;

        $usertype = Auth::user()->usertype_id;

        $sender = ($usertype != 1 ? Auth::user()->karyawan_id : $request->sender_id);

        $tab = AllhoActivities::find($id);

        $tab->tgl = HelpMe::tgl_indo_to_sql($request->tgl);
        $tab->delivery_id = $request->delivery_id;
        // $tab->goods_condition_id = $request->goods_condition_id;
        $tab->fromarea_id = $request->fromarea_id;
        $tab->toarea_id = $request->toarea_id;
        $tab->recipient_id = $request->recipient_id;
        $tab->project_id = $request->project_id;
        $tab->receipt_no = $request->receipt_no;
        $tab->sender_id = $sender;
        $tab->save();

        $detailDelete = AllhoActivitiesDetail::where('allho_activities_id', '=', $id)->delete();

        $tools = array();
        $isToll = false;
        $no=0;
        foreach($request->idTools AS $idTool){
          $tools[] = array('allho_activities_id'=>$tab->id, 'tools_id'=>$idTool, 'goods_condition_id'=>$request->goods_condition_id[$no]);
          $isTool = true;
          $no++;
        }

        if($isTool) $bulkTools = AllhoActivitiesDetail::insert($tools);

        return $tab;
    }
}
