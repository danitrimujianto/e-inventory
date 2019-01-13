<?php
namespace App\Core\Readers;

use App\ToolsKaryawan;

use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use HelpMe;

class ReportEmployeeToolsReader implements Reader
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

      $data = ToolsKaryawan::where('renew_date', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('renew_date', '<=', HelpMe::tgl_indo_to_sql($second_date));

      $data = $data->orderBy('renew_date','asc')->get();

      // $data = $data->whereHas('purchase_request', function ($q) use($first_date, $second_date){
      //   $q->where('tanggal', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('tanggal', '<=', HelpMe::tgl_indo_to_sql($second_date));
      // });

      return $data;
    }
}
