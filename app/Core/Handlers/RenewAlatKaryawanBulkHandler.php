<?php
namespace App\Core\Handlers;

use App\ToolsKaryawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class RenewAlatKaryawanBulkHandler implements Handler
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $req = $this->request;
        $data = $this->saveDB($req);
        return $data;
    }

    private function saveDB($req)
    {
        $usertype = Auth::user()->usertype_id;
        // dd($req);
        // echo $req['idTools'][0];
        foreach ($req->idTools as $key => $value) {
          $tab = ToolsKaryawan::where('karyawan_id', Auth::user()->karyawan_id)->where('tools_id', $value)->update(['renew_date' => date('Y-m-d')]);
        }

        return $tab;
    }
}
