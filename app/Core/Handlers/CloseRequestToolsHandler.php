<?php
namespace App\Core\Handlers;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\EmailExternal;
use App\AllhoActivitiesDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;
use Notifiable;

class CloseRequestToolsHandler implements Handler
{
    private $request;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $id = $this->id;
        $data = $this->saveDB($id);
        return $data;
    }

    private function saveDB($id)
    {
        $usertype = Auth::user()->usertype_id;

        $tab = PurchaseRequest::find($id);
        $tab->appfi_date = date("Y-m-d H:i:s");
        $tab->status = "3";
        $tab->save();

        return $tab;
    }
}
