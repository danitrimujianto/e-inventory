<?php
namespace App\Core\Export;

use App\AllhoActivities;
use App\AllhoActivitiesDetail;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class ReportHandoverExcel implements FromView
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
      $req = $this->request;
      $first_date = (isset($req->first_date) ? $req->first_date : '');
      $second_date = (isset($req->second_date) ? $req->second_date : '');

      $data = new AllhoActivitiesDetail;
      $data = $data->whereHas('allhoactivities', function ($q) use($first_date, $second_date){
        $q->where('tgl', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tgl', '<=', HelpMe::tgl_indo_to_sql($second_date));
      });
      $data = $data->get();

      return view('layouts.print', [
          'data' => $data,
          'modul' => 'rephandover'
      ]);
    }

}
