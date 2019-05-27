<?php
namespace App\Core\Readers;

use App\ToolsKaryawan;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class AlatKaryawanReader implements Reader
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

      $data = new ToolsKaryawan;

      if(Auth::user()->usertype_id == 4 || Auth::user()->usertype_id == 5){
        $data = $data->where('karyawan_id', Auth::user()->karyawan_id);
      }


      // if(is_array($sf)){
      //   foreach($sf AS $k=>$v){
      //     if(!empty($v)){
      //       $data = $data->whereHas('tools', function($q) use ($k, $v){
      //         $q->where($k, 'like', '%'.$v.'%');
      //       });
      //       // $data = $data->where($k, 'like', '%'.$v.'%');
      //     }
      //   }
      // }

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
        else if($sf == "serial_number")
        {
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('serial_number', 'like', '%'.$sq.'%');
          });
        }
        else if($sf == "imei")
        {
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('imei', 'like', '%'.$sq.'%');
          });
        }
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

      $data = new ToolsKaryawan;

      if(Auth::user()->usertype_id == 4 || Auth::user()->usertype_id == 5){
        $data = $data->where('karyawan_id', Auth::user()->karyawan_id);
      }

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

      $data = $data->orderBy('id','desc')->get();

      return $data;
    }
}
