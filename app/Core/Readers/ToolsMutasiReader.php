<?php
namespace App\Core\Readers;

use App\Tools;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class ToolsMutasiReader implements Reader
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
      $usertype = Auth::user()->usertype_id;
      $karyawan_id = Auth::user()->karyawan_id;

      $data = new Tools;

      if(!empty($sq))
      {
        $data = $data->where(function($q) use($sq) {
          $q->where('code', 'like', '%'.$sq.'%')
            ->orWhere('item', 'like', '%'.$sq.'%');
        });
      }

      if($usertype == 4)
      {
        $data = $data->where('karyawan_id', $karyawan_id);
      }elseif($usertype == 2 || $usertype == 1){
        $data = $data->whereNull('karyawan_id');
      }
      // dd($data->toSql());
      $data = $data->get();

      return $data;
    }
}
