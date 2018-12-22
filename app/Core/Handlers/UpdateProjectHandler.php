<?php
namespace App\Core\Handlers;

use App\Project;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class UpdateProjectHandler implements Handler
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
        $tab = Project::find($id);
        $tab->name = $request->name;
        $tab->vendor_id = $request->vendor_id;
        $tab->area_id = $request->area_id;
        $tab->city_id = $request->city_id;
        $tab->start_date = HelpMe::tgl_indo_to_sql($request->start_date);
        $tab->end_date = HelpMe::tgl_indo_to_sql($request->end_date);
        $tab->remarks = $request->remarks;
        $tab->save();

        return $tab;
    }
}
