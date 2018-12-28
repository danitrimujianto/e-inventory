<?php
namespace App\Core\Readers;

use App\AllhoActivities;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class AllhoActivitiesUserReader implements Reader
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

      $data = AllhoActivities::where('type', 'user');
      if(!empty($sq))
      {
        if($sf == 'recipient'){
          $data = $data->with('Karyawan')->whereHas('Karyawan', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      if(Auth::user()->usertype_id != 1){ $data = $data->where('sender_id', Auth::user()->karyawan_id); }

      $data = $data->orderBy('id','desc')->paginate($batas);
      return $data;
    }
}
