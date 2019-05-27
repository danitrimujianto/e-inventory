<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Readers\DivisionReader;
use App\Core\Readers\BarangReader;
use App\Core\Readers\SupplierReader;
use App\Core\Readers\RequestToolsReader;

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
      $dDivision = $reader->readData();
      $this->returnData['dDivision'] = $dDivision;

      $reader = new BarangReader($request);
      $dBarang = $reader->readData();
      $this->returnData['dBarang'] = $dBarang;

      $reader = new SupplierReader($request);
      $dSupplier = $reader->readData();
      $this->returnData['dSupplier'] = $dSupplier;

      $reader = new RequestToolsReader($request);
      $dItems = $reader->getItem();
      $this->returnData['dItems'] = $dItems;

      return view('modal.'.$pos, $this->returnData);
    }
}
