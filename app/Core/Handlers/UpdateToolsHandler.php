<?php
namespace App\Core\Handlers;

use App\Tools;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateToolsHandler implements Handler
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
        $tab = Tools::find($id);
        $tab->item = $request->item;
        $tab->merk = $request->merk;
        $tab->type = $request->type;
        $tab->serial_number = $request->serial_number;
        $tab->imei = $request->imei;
        $tab->price = HelpMe::normalNumber($request->price);
        $tab->remarks = $request->remarks;
        $tab->tgl = HelpMe::tgl_indo_to_sql($request->tgl);
        $tab->save();

        return $tab;
    }
}
