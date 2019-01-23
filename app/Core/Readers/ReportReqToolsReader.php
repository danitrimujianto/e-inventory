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

      $data = new PurchaseRequestDetail;
      $data = $data->whereHas('purchase_request', function ($q) use($first_date, $second_date, $sf, $sq){
        $q->where('tanggal', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tanggal', '<=', HelpMe::tgl_indo_to_sql($second_date));
        $q->where('status', '1');
        $q->with('project');

        if(!empty($sq))
        {
          if($sf == "user_request"){
            $q->whereHas('karyawan', function($q2) use ($sq){
              $q2->where('name', 'like', '%'.$sq.'%');
            });
          }elseif($sf == "project"){
            $q->whereHas('project', function($q2) use ($sq){
              $q2->where('name', 'like', '%'.$sq.'%');
            });
          }else{
              $q->where($sf, 'like', '%'.$sq.'%');
          }
        }
      });
      //
      // if(!empty($sq))
      // {
      //   if($sf == "user_request"){
      //     $data = $data->whereHas('purchase_request', function($q) use ($sq){
      //       $q->whereHas('karyawan', function($q2) use ($sq){
      //         $q2->where('name', 'like', '%'.$sq.'%');
      //       });
      //       $q->where('status', '1');
      //       $q->with('project');
      //     });
      //   }else{
      //     $data = $data->whereHas('purchase_request', function($q) use ($sq, $sf){
      //       $q->where($sf, 'like','%'.$sq.'%');
      //       $q->where('status', '1');
      //       $q->with('project');
      //     });
      //   }
      // }
      if($isExport)
        $data = $data->get();
      else
        $data = $data->paginate($batas);

      return $data;
    }
}
