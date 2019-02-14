<?php
namespace App\Core\Export;

use App\Tools;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Core\Readers\ReportStockToolsReader;
use DB;

class ReportStockToolsPrint implements Reader
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

      $reader = new ReportStockToolsReader($request);
      $data = $reader->read();

      return $data;
    }
}
