<?php
namespace App\Core\Handlers;

use App\GoodsCondition;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddGoodsConditionHandler implements Handler
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

        $tab = new GoodsCondition();
        $tab->code = $request->code;
        $tab->name = $request->name;
        $tab->save();

        return $tab;
    }
}
