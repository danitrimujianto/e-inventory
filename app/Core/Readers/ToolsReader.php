<?php
namespace App\Core\Readers;

use App\Tools;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class ToolsReader implements Reader
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

      $data = new Tools;
      if(is_array($sf)){
        foreach($sf AS $k=>$v){
          if(!empty($v)){
            $data = $data->where($k, 'like', '%'.$v.'%');
          }
        }
      }

      $data = $data->orderBy('id', 'desc')->paginate($batas);
      return $data;
    }
    public function readData()
    {

      $req = $this->request;
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');

      $data = new Tools;
      if(!empty($sq))
      {
        $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
      }

      $data = $data->orderBy('id', 'desc')->get();
      return $data;
    }
}
