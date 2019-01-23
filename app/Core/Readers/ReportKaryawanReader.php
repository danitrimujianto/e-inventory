<?php
namespace App\Core\Readers;

use App\Karyawan;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class ReportKaryawanReader implements Reader
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
      $data = new Karyawan;
      if(!empty($sq))
      {
        if($sf == 'Department')
        {
          $data = $data->whereHas('departemen', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == 'Project')
        {
          $data = $data->whereHas('project', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == 'Assignment Area')
        {
          $data = $data->whereHas('assignmentarea', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      $data = $data->orderBy('id', 'desc');

      if($isExport)
        $data = $data->get();
      else
        $data = $data->paginate($batas);
        
      return $data;
    }
}
