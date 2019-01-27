<?php
namespace App\Core\Readers;

use App\User;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class UserReader implements Reader
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

      $data = new User;
      $data = $data->where('usertype_id', '!=', 1);
      if(!empty($sq))
      {
        if($sf == "type_name")
        {
          $data = $data->whereHas('tipeuser', function($q) use ($sq){
            $q->where('type_name', 'like', '%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }

      $data = $data->paginate($batas);
      return $data;
    }
    public function readData()
    {

      $req = $this->request;
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');

      $data = new User;
      $data = $data->where('usertype_id', '!=', 1);
      if(!empty($sq))
      {
        if($sf == "type_name")
        {
          $data = $data->whereHas('tipeuser', function($q) use ($sq){
            $q->where('type_name', 'like', '%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }

      $data = $data->get();
      return $data;
    }
}
