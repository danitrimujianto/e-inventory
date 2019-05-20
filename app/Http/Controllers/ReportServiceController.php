<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Readers\ReportServiceReader;
use App\Core\Export\ReportServiceExcel;

use Session;
use HelpMe;
use DB;

class ReportServiceController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "repservice"; //disetiap __construct controller harus ada
      $this->modulName = "Report Maintenance"; //disetiap __construct controller harus ada
      $this->theme = array("modul"=>$this->modul, "modulName"=>$this->modulName); //disetiap __construct controller harus ada
      $this->returnData = array();
      $this->HelpMe = new HelpMe();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $pos = 'index';
      $this->theme["page"] = 'index'; //disetiap class dan function controller harus ada
      $first_date = (isset($_REQUEST['first_date']) ? $_REQUEST['first_date'] : '');
      $second_date = (isset($_REQUEST['second_date']) ? $_REQUEST['second_date'] : '');
      $sf = (isset($_REQUEST['sf']) ? $_REQUEST['sf'] : '');
      $sq = (isset($_REQUEST['sq']) ? $_REQUEST['sq'] : '');
      $bts = (isset($_REQUEST['bts']) ? $_REQUEST['bts'] : '');

      try {
        $alert = "";

        $reader = new ReportServiceReader($request);
        $data = $reader->read();

        $this->returnData['theme'] = $this->theme;
        $this->returnData['first_date'] = $first_date;
        $this->returnData['second_date'] = $second_date;
        $this->returnData['bts'] = $bts;
        $this->returnData['data'] = $data;
        $this->returnData['sf'] = $sf;
        $this->returnData['sq'] = $sq;
        $this->returnData['alert'] = $alert;

        return view('home', $this->returnData);
      } catch (\Exception $e) {
        $msg = $this->resultException($e, $pos);
        return redirect($this->modul);
      }
  }

  public function excel(Request $request)
  {
    $pos = "Export Excel";
    try {
      return (new ReportServiceExcel($request))->download('Report Service.xls');
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }

  public function print(Request $request)
  {
    $pos = "Print";
    $first_date = (isset($_REQUEST['first_date']) ? $_REQUEST['first_date'] : '');
    $second_date = (isset($_REQUEST['second_date']) ? $_REQUEST['second_date'] : '');
    $sf = (isset($_REQUEST['sf']) ? $_REQUEST['sf'] : '');
    $sq = (isset($_REQUEST['sq']) ? $_REQUEST['sq'] : '');
    $isExport = true;

    try {

      $reader = new ReportServiceReader($request, $isExport);
      $data = $reader->read();

      return view('layouts.print', ['data' => $data, 'modul' => $this->modul, 'first_date' => $first_date, 'second_date' => $second_date, 'sf' => $sf, 'sq' => $sq]);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }
}
