<?php
namespace App\Core\Handlers;

use App\Warehouse;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddWarehouseHandler implements Handler
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

        $tab = new Warehouse();
        $tab->code = $request->code;
        $tab->name = $request->name;
        $tab->area_id = $request->area_id;
        $tab->city_id = $request->city_id;
        $tab->status = $request->status;
        $tab->remarks = $request->remarks;
        $tab->save();

        return $tab;
    }
}
