<?php
namespace App\Core\Readers;

use App\AllhoActivities;
use App\AllhoActivitiesDetail;

use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;

class ReportHandoverReader implements Reader
{
    private $request;
    /** constructor, fungsinya untuk memudahkan passing variable dari controller */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /** method ini digunakan untuk mengeksekusi query */
    public function read()
    {

      $req = $this->request;
      $first_date = (isset($req->first_date) ? $req->first_date : '');
      $second_date = (isset($req->second_date) ? $req->second_date : '');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');

      $data = new AllhoActivitiesDetail;
      $data = $data->whereHas('allhoactivities', function ($q) use($first_date, $second_date){
        $q->where('tgl', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tgl', '<=', HelpMe::tgl_indo_to_sql($second_date));
      });

      if(!empty($sq))
      {
        if($sf == 'recipient'){
          $data = $data->whereHas('allhoactivities', function($q) use ($sq){
            $q->whereHas('karyawan', function($q2) use ($sq){
              $q2->where('name', 'like', '%'.$sq.'%');
            });
          });
        }elseif($sf == 'outgoing_no'){
          $data = $data->whereHas('allhoactivities', function($q) use ($sq){
            $q->where('outgoing_no', 'like','%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      $data = $data->get();
      return $data;
    }
}
