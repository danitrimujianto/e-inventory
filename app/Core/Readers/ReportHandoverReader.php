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
    private $isExport;
    /** constructor, fungsinya untuk memudahkan passing variable dari controller */
    public function __construct(Request $request, $isExport = false)
    {
        $this->request = $request;
        $this->isExport = $isExport;
    }

    /** method ini digunakan untuk mengeksekusi query */
    public function read()
    {
      $isExport = $this->isExport;
      $req = $this->request;
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
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
        }elseif($sf == 'ID Tools'){
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('code', 'like','%'.$sq.'%');
          });
        }elseif($sf == 'Item'){
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('item', 'like','%'.$sq.'%');
          });
        }elseif($sf == 'Serial Number'){
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('serial_number', 'like','%'.$sq.'%');
          });
        }elseif($sf == 'Project'){
          $data = $data->whereHas('allhoactivities', function($q) use ($sq){
            $q->whereHas('project', function($q2) use ($sq){
              $q2->where('name', 'like','%'.$sq.'%');
            });
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }

      if($isExport)
        $data = $data->get();
      else
        $data = $data->paginate($batas);

      return $data;
    }
}
