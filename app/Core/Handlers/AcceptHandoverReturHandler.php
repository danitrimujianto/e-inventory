<?php
namespace App\Core\Handlers;

use App\ReturTools;
use App\ReturToolsDetail;
use App\ToolsKaryawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AcceptHandoverReturHandler implements Handler
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
        $karyawan_id = Auth::user()->karyawan_id;

        $tab = ReturTools::find($id);
        $tab->accept_date = date("Y-m-d H:i:s");
        $tab->accepted_by = $karyawan_id;
        $tab->status = "1";
        $tab->save();

        $tools_sender = ToolsKaryawan::where('karyawan_id', $tab->karyawan_id)->get();
        $getDet = ReturToolsDetail::where("retur_tools_id", '=', $id)->select('tools_id', 'goods_condition_id')->get();
        $total = $getDet->count();

        $updet = 'UPDATE tools SET karyawan_id = CASE id ';
        $delExist = 'DELETE FROM tools_karyawan WHERE (karyawan_id, tools_id) IN ';

        $idUpdate = "";
        $idExist = "";
        $counter = 0;
        foreach($getDet AS $det){
          $counter++;
          $updet .= ' WHEN '.$det['tools_id'].' THEN NULL';
          $idUpdate .= $det['tools_id']. ($counter < $total ? "," : "");
          $idExist .= '('.$tab->karyawan_id.', '.$det['tools_id'].')'. ($counter < $total ? "," : "");
        }

        //update tools karyawan_id
        $updet .= " END WHERE id IN(".$idUpdate.")";
        \DB::insert($updet);

        //delete tools
        $delExist .= '('.$idExist.')';
        if($tools_sender->count() > 0)
        {  \DB::statement($delExist); }

        return $tab;
    }
}
