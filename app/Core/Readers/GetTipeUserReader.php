<?php
namespace App\Core\Readers;

use App\TipeUser;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class GetTipeUserReader implements Reader
{
    private $request;
    /** constructor, fungsinya untuk memudahkan passing variable dari controller */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /** method ini digunakan untuk mengeksekusi query */
    public function read()
    {
      $id = $this->id;

      $data = TipeUser::find($id);

      return $data;
    }
}
