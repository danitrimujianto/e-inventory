<?php
namespace App\Core\Handlers;

use App\Tools;
use App\Division;
use App\Barang;
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
        $tab->save();

        return $tab;
    }

    private function kodeTools($division_id, $barang_id)
    {
      $tools = Tools::where('division_id', $division_id)->where('barang_id', $barang_id)->orderBy('id', 'desc')->first();
      $code = ($tools['urut']+1);

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
