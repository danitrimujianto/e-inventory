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

class GenerateCodeToolsHandler implements Handler
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

        $tools = Tools::orderBy('id', 'ASC')->get();

        // $idTools = $this->kodeTools(17, 17);
        // echo $idTools;
        foreach($tools as $tool){
            $save = $this->saveCode($tool);
            if($save)
            {
              echo $tool->id.' - '.$tool->division_id.' - '.$tool->barang_id.' - sukses - '.$save->code.' <br> ';
            }else{
              echo $tool->id.' - '.$tool->division_id.' - '.$tool->barang_id.' - gagal <br>';
            }
        }

        return $path;
    }

    private function saveCode($data)
    {
        $idTools = $this->kodeTools($data->division_id, $data->barang_id);

        $div = Division::find($data->division_id);
        $divisionCode = $div->code;

        $barang = Barang::find($data->barang_id);
        $barangCode = $barang->code;

        $toolGet = Tools::find($data->id);

        $toolGet->code = $divisionCode.$barangCode.$idTools;
        $toolGet->urut = $idTools;
        $toolGet->save();

        if($toolGet)
        {  return $toolGet; }
        else
        {  return false; }
    }

    private function kodeTools($division_id, $barang_id)
    {
      $nmr = 0;

      $tools = Tools::where('division_id', $division_id)->where('barang_id', $barang_id)->orderBy('urut', 'desc')->first();

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
