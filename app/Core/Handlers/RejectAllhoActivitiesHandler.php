<?php
namespace App\Core\Handlers;

use App\AllhoActivities;
use App\AllhoActivitiesDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class RejectAllhoActivitiesHandler implements Handler
{
    private $request;

    public function __construct($request, $id)
    {
        $this->id = $id;
        $this->request = $request;
    }

    public function handle()
    {
        $id = $this->id;
        $request = $this->request;
        $data = $this->saveDB($request, $id);
        return $data;
    }

    private function saveDB($request, $id)
    {
        $usertype = Auth::user()->usertype_id;
        $karyawan_id = Auth::user()->karyawan_id;

        $tab = AllhoActivities::find($id);
        $tab->rejected_date = date("Y-m-d H:i:s");
        $tab->rejected_by = $karyawan_id;
        $tab->keterangan_batal = $request->keterangan_batal;
        $tab->status = "99";
        $tab->save();

        return $tab;
    }
}
