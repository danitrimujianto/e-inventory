<?php
namespace App\Core\Readers;

use App\AllhoActivitiesDetail;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class AllhoActivitiesDetailReader implements Reader
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

      $data = AllhoActivities::where('type', 'allho');
      if(!empty($sq))
      {
        $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
      }

      $data = $data->paginate($batas);
      return $data;
    }
}
