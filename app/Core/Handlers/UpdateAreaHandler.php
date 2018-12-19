<?php
namespace App\Core\Handlers;

use App\Area;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateAreaHandler implements Handler
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
        $tab = Area::find($id);
        $tab->code = $request->code;
        $tab->name = $request->name;
        $tab->remarks = $request->remarks;
        $tab->save();

        return $tab;
    }
}
