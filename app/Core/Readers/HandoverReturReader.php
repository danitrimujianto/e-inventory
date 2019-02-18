<?php
namespace App\Core\Readers;

use App\ReturTools;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class HandoverReturReader implements Reader
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
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');
      $usertype = Auth::user()->usertype_id;
      $karyawan_id = Auth::user()->karyawan_id;

      $data = new ReturTools();

      if($usertype == 4){
        $data = $data->where('karyawan_id', $karyawan_id);
      }

      if(!empty($sq))
      {
        if($sf == 'from'){
          $data = $data->with('Karyawan')->whereHas('Karyawan', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }

      $data = $data->orderBy('id','desc')->paginate($batas);
      return $data;
    }

    public function readData()
    {

    }
}
