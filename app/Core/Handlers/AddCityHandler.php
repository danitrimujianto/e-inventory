<?php
namespace App\Core\Handlers;

use App\City;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddCityHandler implements Handler
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

        $tab = new City();
        $tab->code = $request->code;
        $tab->name = $request->name;
        $tab->remarks = $request->remarks;
        $tab->save();

        return $tab;
    }
}
