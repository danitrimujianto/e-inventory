<?php
namespace App\Core\Readers;

use App\ToolsKaryawan;
use App\Karyawan;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class OtherEmployeeToolsReader implements Reader
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

      $user = Karyawan::find(Auth::user()->karyawan_id);
      $homebasearea_id = $user->homebasearea_id;

      $data = new ToolsKaryawan;

      $data = $data->where('karyawan_id', '!=', Auth::user()->karyawan_id)->whereHas('karyawan', function($q) use($homebasearea_id){
        $q->where('homebasearea_id', $homebasearea_id);
      });

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
          $data = $data->whereHas('project', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
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

      $user = Karyawan::find(Auth::user()->karyawan_id);
      $assignmentarea_id = $user->assignmentarea_id;

      $data = new ToolsKaryawan;

      $data = $data->where('karyawan_id', '!=', Auth::user()->karyawan_id)->whereHas('karyawan', function($q) use($assignmentarea_id){
        $q->where('assignmentarea_id', $assignmentarea_id);
      });

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
          $data = $data->whereHas('project', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }
      }

      $data = $data->orderBy('id','desc')->get();

      return $data;
    }
}
