<?php
namespace App\Core\Handlers;

use App\Service;
use App\Karyawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class FinishServiceHandler implements Handler
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
        $tab = Service::find($id);
        $tab->finish_date = HelpMe::tgl_indo_to_sql($request->finish_date);
        if(!empty($request->service)){ $tab->service = $request->service; }
        if(!empty($request->after_id)){ $tab->after_id = $request->after_id; }
        $tab->status = "2";
        $tab->save();

        return $tab;
    }
}
