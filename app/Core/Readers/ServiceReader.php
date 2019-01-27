<?php
namespace App\Core\Readers;

use App\Service;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class ServiceReader implements Reader
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

      $data = new Service;
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
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      if(Auth::user()->usertype_id != 1){ $data = $data->where('karyawan_id', Auth::user()->karyawan_id); }

      $data = $data->orderBy('id','desc')->paginate($batas);
      return $data;
    }
    public function readData()
    {

      $req = $this->request;
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');

      $data = new Service;
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
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      if(Auth::user()->usertype_id != 1){ $data = $data->where('karyawan_id', Auth::user()->karyawan_id); }

      $data = $data->orderBy('id','desc')->get();
      return $data;
    }
}
