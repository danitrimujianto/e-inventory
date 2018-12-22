<?php
namespace App\Core\Handlers;

use App\Karyawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateKaryawanHandler implements Handler
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

        $tab = Karyawan::find($id);
        $tab->id_karyawan = $request->id_karyawan;
        $tab->name = $request->name;
        $tab->departemen_id = $request->departemen_id;
        $tab->position_id = $request->position_id;
        $tab->project_id = $request->project_id;
        $tab->homebasearea_id = $request->homebasearea_id;
        $tab->assignmentarea_id = $request->assignmentarea_id;
        $tab->phone_number = $request->phone_number;
        $tab->email = $request->email;
        $tab->status = $request->status;
        $tab->save();

        return $tab;
    }
}
