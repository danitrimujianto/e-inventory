<?php
namespace App\Core\Handlers;

use App\Position;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdatePositionHandler implements Handler
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
        $tab = Position::find($id);
        $tab->code = $request->code;
        $tab->position = $request->position;
        $tab->remarks = $request->remarks;
        $tab->save();

        return $tab;
    }
}
