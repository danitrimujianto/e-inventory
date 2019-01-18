<?php
namespace App\Core\Export;

use App\PurchaseRequest;
use App\PurchaseRequestDetail;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class ReportReqToolsExcel implements FromView
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->request  = $request;
        $this->modul    = 'repreqtools';
    }

    public function view(): View
    {
      $req = $this->request;
      $first_date = (isset($req->first_date) ? $req->first_date : '');
      $second_date = (isset($req->second_date) ? $req->second_date : '');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');

      $data = new PurchaseRequestDetail;
      $data = $data->whereHas('purchase_request', function ($q) use($first_date, $second_date, $sf, $sq){
        $q->where('tanggal', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tanggal', '<=', HelpMe::tgl_indo_to_sql($second_date));
        $q->where('status', '1');

        if(!empty($sq))
        {
          if($sf == "user_request"){
            $q->whereHas('karyawan', function($q2) use ($sq){
              $q2->where('name', 'like', '%'.$sq.'%');
            });
          }else{
              $q->where($sf, 'like', '%'.$sq.'%');
          }
        }
      });
      $data = $data->get();

      return view('layouts.print', [
          'data' => $data,
          'modul' => $this->modul,
          'first_date' => $first_date,
          'second_date' => $second_date,
          'sf' => $sf,
          'sq' => $sq
      ]);
    }

}
