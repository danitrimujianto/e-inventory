<?php
namespace App\Core\Handlers;

use App\Tools;
use App\InputTools;
use App\Division;
use App\Barang;
use App\PurchaseRequestDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddToolsHandler implements Handler
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
        $path = "";

        $div = Division::find($request->division_id);
        $divisionCode = $div->code;

        $barang = Barang::find($request->barang_id);
        $barangCode = $barang->code;

        $idTools = $this->kodeTools($request->division_id, $request->barang_id);
        $tab = new Tools();
        $tab->code = $divisionCode.$barangCode.$idTools;
        $tab->urut = $idTools;
        $tab->division_id = $request->division_id;
        $tab->barang_id = $request->barang_id;
        $tab->item = $request->item;
        $tab->merk = $request->merk;
        $tab->type = $request->type;
        $tab->serial_number = $request->serial_number;
        $tab->imei = $request->imei;
        $tab->price = HelpMe::normalNumber($request->price);
        $tab->remarks = $request->remarks;
        $tab->created_by = Auth::user()->name;
        $tab->tgl = HelpMe::tgl_indo_to_sql($request->tgl);
        $tab->supplier_id = $request->supplier_id;
        $tab->save();

        if(!empty($request->purchase_request_id)){
          $updateItem = PurchaseRequestDetail::find($request->item_id);
          $updateItem->input = 1;
          $updateItem->jml_input = $updateItem->jml_input+1;
          $updateItem->save();

          $tabInput = new InputTools();
          $tabInput->purchase_request_id = $request->purchase_request_id;
          $tabInput->code = $tab->code;
          $tabInput->urut = $tab->urut;
          $tabInput->division_id = $tab->division_id;
          $tabInput->barang_id = $tab->barang_id;
          $tabInput->item = $tab->item;
          $tabInput->merk = $tab->merk;
          $tabInput->type = $tab->type;
          $tabInput->serial_number = $tab->serial_number;
          $tabInput->imei = $tab->imei;
          $tabInput->price = $tab->price;
          $tabInput->remarks = $tab->remarks;
          $tabInput->created_by = $tab->created_by;
          $tabInput->tgl = $tab->tgl;
          $tabInput->supplier_id = $tab->supplier_id;
          $tabInput->save();

        }
        return $tab;
    }

    private function kodeTools($division_id, $barang_id)
    {
      $nmr = 0;

      $tools = DB::table('tools')->where('division_id', $division_id)->where('barang_id', $barang_id)->orderBy('id', 'desc')->first();

      if($tools){
        $nmr = $tools->urut;
      }

      $code = ($nmr+1);

      if(strlen($code) == 1)
      { $code = '00000'.$code; }
      elseif(strlen($code) == 2)
      { $code = '0000'.$code; }
      elseif(strlen($code) == 3)
      { $code = '000'.$code; }
      elseif(strlen($code) == 4)
      { $code = '00'.$code; }
      elseif(strlen($code) == 5)
      { $code = '0'.$code; }
      elseif(strlen($code) == 6)
      { $code = $code; }

      return $code;
    }
}
