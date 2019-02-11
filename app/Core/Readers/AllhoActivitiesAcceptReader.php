<?php
namespace App\Core\Readers;

use App\AllhoActivities;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class AllhoActivitiesAcceptReader implements Reader
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
      // $status = ((Auth::user()->usertype_id == "3") ? "0" :
      //             (Auth::user()->usertype_id == "4") ? "1" : "");

      if($usertype == 4 || $usertype == 5)
      {
        $opr = ">=";
        $status = "1";
      }else{
        $opr = "=";
        $status = "0";
      }

      $data = new AllhoActivities;

      if($usertype == 2)
      {
        $data = $data->where('type', 'user');
      }

      $data = $data->where('status', $opr, $status);

      if(!empty($sq))
      {
        if($sf == 'from'){
          $data = $data->with('Sender')->whereHas('Sender', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          })->orWhere('type', 'like', '%'.$sq.'%');
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      if(Auth::user()->usertype_id == 4 || Auth::user()->usertype_id == 5){
        $data = $data->where('recipient_id', Auth::user()->karyawan_id);
      }

      $data = $data->orderBy('id','desc')->paginate($batas);


      return $data;
    }
    public function readData()
    {

      $req = $this->request;
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');
      $usertype = Auth::user()->usertype_id;
      // $status = ((Auth::user()->usertype_id == "3") ? "0" :
      //             (Auth::user()->usertype_id == "4") ? "1" : "");

      $status2 = "";
      if($usertype == 4 || $usertype == 5)
      {
        $opr = ">=";
        $status = "6";

        $opr2 = "<=";
        $status2 = "98";
      }else{
        $opr = "=";
        $status = "0";
      }

      $data = new AllhoActivities;

      if($usertype == 2)
      {
        $data = $data->where('type', 'user');
      }

      $data = $data->where('status', $opr, $status);
      if($status2 != ""){ $data = $data->where('status', $opr2, $status2); }

      if(!empty($sq))
      {
        if($sf == 'from'){
          $data = $data->with('Sender')->whereHas('Sender', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          })->orWhere('type', 'like', '%'.$sq.'%');
        }else{
          $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
        }
      }
      if(Auth::user()->usertype_id == 4 || Auth::user()->usertype_id == 5){
        $data = $data->where('recipient_id', Auth::user()->karyawan_id);
      }
      dd($data);
      $data = $data->orderBy('id','desc')->get();

      return $data;
    }
}
