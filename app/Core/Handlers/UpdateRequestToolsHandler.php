<?php
namespace App\Core\Handlers;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateRequestToolsHandler implements Handler
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

        $tab = PurchaseRequest::find($id);
        $tab->tanggal = HelpMe::tgl_indo_to_sql($request->tanggal);
        $tab->karyawan_id = $request->karyawan_id;
        $tab->due_date = HelpMe::tgl_indo_to_sql($request->due_date);
        $tab->description = $request->description;
        $tab->save();

        $detailDelete = PurchaseRequestDetail::where('purchase_request_id', '=', $id)->delete();

        $tools = array();
        $isToll = false;
        $no=0;
        foreach($request->item AS $item){
          if(!empty($item)){
            $tools[] = array(
                          'purchase_request_id'=>$tab->id,
                          'item'=>$item,
                          'merk'=>$request->merk[$no],
                          'type'=>$request->type[$no],
                          'quantity'=>HelpMe::normalNumber($request->quantity[$no]),
                          'price'=>HelpMe::normalNumber($request->price[$no]),
                          'total'=>HelpMe::normalNumber($request->subtotal[$no])
                        );
            $isTool = true;
          }
          $no++;
        }

        if($isTool) $bulkTools = PurchaseRequestDetail::insert($tools);

        return $tab;
    }
}
