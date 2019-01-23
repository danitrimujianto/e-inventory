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

      $data = ToolsKaryawan::where('renew_date', '>=', HelpMe::tgl_indo_to_sql($first_date))->where('renew_date', '<=', HelpMe::tgl_indo_to_sql($second_date));
      if(!empty($sq))
      {
        if($sf == "item")
        {
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('item', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == "code_tools")
        {
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('code', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == "karyawan")
        {
          $data = $data->whereHas('karyawan', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == "project")
        {
          $data = $data->whereHas('karyawan', function($q) use ($sq){
            $q->whereHas('project', function($q2) use ($sq){
              $q2->where('name', 'like', '%'.$sq.'%');
            });
          });
        }
      }
      $data = $data->orderBy('renew_date','asc');

      if($isExport)
        $data = $data->get();
      else
        $data = $data->paginate($batas);

      return $data;
    }
}
