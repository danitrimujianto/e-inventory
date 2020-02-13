<?php
namespace App\Core\Handlers;

use App\Service;
use App\ServiceDetail;
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
        $tab->tanggal = HelpMe::tgl_indo_to_sql($request->tanggal);
        $tab->start_date = HelpMe::tgl_indo_to_sql($request->start_date);
        $tab->remarks = $request->remarks;
        $tab->karyawan_id = $karyawan_id;
        $tab->save();

        $delDetil = ServiceDetail::where('service_id', $id)->delete();

        if($delDetil){
            foreach($request->idTools AS $k=>$v){
                $model = new ServiceDetail;
                $model->service_id = $tab->id;
                $model->tools_id = $v;
                $model->price = HelpMe::nominalSql2($request->price[$k]);
                $model->condition_id = $request->goods_condition_id[$k];
                $model->problem = $request->problem[$k];
                $model->save();
            }
        }

        return $tab;
    }
}
