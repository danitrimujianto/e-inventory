<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Readers\DivisionReader;
use App\Core\Readers\BarangReader;

class ModalController extends Controller
{
    public function reject(Request $request)
    {
      $pos = 'reject';

      return view('modal.'.$pos, $request);
    }

    public function inputTools(Request $request)
    {
      $pos = 'inputTools';
      $this->returnData['data'] = "";

      $reader = new DivisionReader($request);
      $dDivision = $reader->read();
      $this->returnData['dDivision'] = $dDivision;

      $reader = new BarangReader($request);
      $dBarang = $reader->read();
      $this->returnData['dBarang'] = $dBarang;

      return view('modal.'.$pos, $this->returnData);
    }
}
