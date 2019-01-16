<?php
namespace App\Core\Readers;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;

use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;

class ReportReqToolsReader implements Reader
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
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');

      $data = new PurchaseRequestDetail;
      $data = $data->whereHas('purchase_request', function ($q) use($first_date, $second_date){
        $q->where('tanggal', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tanggal', '<=', HelpMe::tgl_indo_to_sql($second_date));
      });

      if(!empty($sq))
      {
        if($sf == "user_request"){
          $data = $data->whereHas('purchase_request', function($q) use ($sq){
            $q->whereHas('karyawan', function($q2) use ($sq){
              $q2->where('name', 'like', '%'.$sq.'%');
            });
          });
        }else{
          $data = $data->whereHas('purchase_request', function($q) use ($sq, $sf){
            $q->where($sf, 'like','%'.$sq.'%');
          });
        }
      }
      $data = $data->get();

      return $data;
    }
}
