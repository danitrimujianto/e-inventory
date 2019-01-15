<?php
namespace App\Core\Handlers;

use App\EmailExternal;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateEmailExternalHandler implements Handler
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
        $tab = EmailExternal::find($id);
        $tab->name = $request->name;
        $tab->email = $request->email;
        $tab->type = $request->type;
        $tab->save();

        return $tab;
    }
}
