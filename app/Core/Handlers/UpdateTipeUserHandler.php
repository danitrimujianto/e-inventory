<?php
namespace App\Core\Handlers;

use App\TipeUser;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateTipeUserHandler implements Handler
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
        $tab = TipeUser::find($id);
        $tab->type_name = $request->type_name;
        $tab->save();

        return $tab;
    }
}
