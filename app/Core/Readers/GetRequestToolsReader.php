<?php
namespace App\Core\Readers;

use App\InputTools;
use App\PurchaseRequest;
use App\PurchaseRequestDetail;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class GetRequestToolsReader implements Reader
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

      $data = PurchaseRequest::find($id);

      return $data;
    }

    public function getItemDetail()
    {
      $id = $this->id;

      $data = PurchaseRequestDetail::find($id);

      return $data;
    }

    public function history(){
      
      $id = $this->id;
      $data = InputTools::where('purchase_request_id', $id)->get();

      return $data;
    }
}
