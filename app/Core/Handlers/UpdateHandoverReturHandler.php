<?php
namespace App\Core\Handlers;

use App\ReturTools;
use App\ReturToolsDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateHandoverReturHandler implements Handler
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

        $karyawan_id = (Auth::user()->karyawan_id != '' ? Auth::user()->karyawan_id : $request->karyawan_id);

        $tab = ReturTools::find($id);
        $tab->tgl = HelpMe::tgl_indo_to_sql($request->tgl);
        $tab->delivery_id = $request->delivery_id;
        $tab->project_id = $request->project_id;
        $tab->karyawan_id = $karyawan_id;
        $tab->remarks = $request->remarks;
        $tab->save();

        $detailDelete = ReturToolsDetail::where('retur_tools_id', '=', $id)->delete();

        $tools = array();
        $isTool = false;
        $no=0;
        foreach($request->idTools AS $idTool){
          $tools[] = array('id'=>$request->id_detail[$no], 'retur_tools_id'=>$tab->id, 'tools_id'=>$idTool, 'goods_condition_id'=>$request->goods_condition_id[$no]);
          $isTool = true;
          $no++;
        }

        if($isTool) $bulkTools = ReturToolsDetail::insert($tools);

        return $tab;
    }
}
