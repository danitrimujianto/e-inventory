<?php
namespace App\Core\Handlers;

use App\Service;
use App\AllhoActivitiesDetail;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateServiceHandler implements Handler
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

        $usertype = Auth::user()->usertype_id;

                $karyawan_id = Auth::user()->karyawan_id;

        $tab = Service::find($id);
        $tab->tools_id = $request->tools_id;
        $tab->tanggal = HelpMe::tgl_indo_to_sql($request->tanggal);
        $tab->start_date = HelpMe::tgl_indo_to_sql($request->start_date);
        $tab->finish_date = HelpMe::tgl_indo_to_sql($request->finish_date);
        $tab->problem = $request->problem;
        $tab->service = $request->service;
        $tab->condition_id = $request->condition_id;
        $tab->after_id = $request->after_id;
        $tab->remarks = $request->remarks;
        $tab->karyawan_id = $karyawan_id;
        $tab->save();

        return $tab;
    }
}
