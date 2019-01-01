<?php
namespace App\Core\Handlers;

use App\ToolsKaryawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class RenewAlatKaryawanHandler implements Handler
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

        $tab = ToolsKaryawan::where('karyawan_id', Auth::user()->karyawan_id)->update(['renew_date' => date('Y-m-d')]);

        return $tab;
    }
}
