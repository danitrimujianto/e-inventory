<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function reject(Request $request)
    {
      $pos = 'reject';

      return view('modal.'.$pos, $request);
    }
}
