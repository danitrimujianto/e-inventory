<?php
namespace App\Core\Readers;

use App\Service;

use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;

class ReportServiceReader implements Reader
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
      $first_date = (isset($req->first_date) ? $req->first_date : '');
      $second_date = (isset($req->second_date) ? $req->second_date : '');
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');

      $data = Service::where('tanggal', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tanggal', '<=', HelpMe::tgl_indo_to_sql($second_date));
      if(!empty($sq))
      {
        if($sf == 'item'){
          $data = $data->with('Tools')->whereHas('Tools', function($q) use ($sq){
            $q->where('item', 'like', '%'.$sq.'%');
          });
        }elseif($sf == 'code'){
          $data = $data->with('Tools')->whereHas('Tools', function($q) use ($sq){
            $q->where('code', 'like', '%'.$sq.'%');
          });
        }elseif($sf == 'serial_number'){
          $data = $data->with('Tools')->whereHas('Tools', function($q) use ($sq){
            $q->where('serial_number', 'like', '%'.$sq.'%');
          });
        }elseif($sf == 'imei'){
          $data = $data->with('Tools')->whereHas('Tools', function($q) use ($sq){
            $q->where('imei', 'like', '%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }

      $data = $data->orderBy('tanggal','asc');

      if($isExport)
        $data = $data->get();
      else
        $data = $data->paginate($batas);

      return $data;
    }
}
