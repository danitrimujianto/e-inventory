<?php
namespace App\Core\Handlers;

use App\ReturTools;
use App\ReturToolsDetail;
use App\User;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddHandoverReturHandler implements Handler
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
        // $detail = $this->getHandoverDetail($data->id);
        // if($data->type == 'user'){ $sendnotif = $this->sendnotif($data, $detail); }

        return $data;
    }

    private function saveDB($request)
    {
        $karyawan_id = (Auth::user()->karyawan_id != '' ? Auth::user()->karyawan_id : $request->karyawan_id);

        $kode = $this->kode();

        $tab = new ReturTools();
        $tab->kode = $kode;
        $tab->tgl = HelpMe::tgl_indo_to_sql($request->tgl);
        $tab->delivery_id = $request->delivery_id;
        $tab->project_id = $request->project_id;
        $tab->karyawan_id = $karyawan_id;
        $tab->remarks = $request->remarks;
        $tab->save();

        $tools = array();
        $isTool = false;
        $no=0;
        foreach($request->idTools AS $idTool){
          if(!empty($idTool)){
            $tools[] = array('retur_tools_id'=>$tab->id, 'tools_id'=>$idTool, 'goods_condition_id'=>$request->goods_condition_id[$no]);
            $isTool = true;
          }
          $no++;
        }

        if($isTool) $bulkTools = ReturToolsDetail::insert($tools);
        return $tab;
    }

    private function kode()
    {
      $prefix = "RT";
      $bln = (strlen(date('m')) == 1 ? '0'.date('m') : date('m'));
      $thn = date('Y');

      $data = ReturTools::whereMonth('tgl', $bln)->whereYear('tgl', $thn)->orderBy('id', 'desc')->first();
      $new_no = (substr($data["kode"], 6, 5)+1);

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
}
