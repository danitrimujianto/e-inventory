<?php
namespace App\Core\Readers;

use App\TipeUser;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class TipeUserReader implements Reader
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

      $data = new TipeUser;
      $data = $data->where('id', '!=', 1);
      if(!empty($sq))
      {
        $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
      }

      $data = $data->paginate($batas);
      return $data;
    }
}
