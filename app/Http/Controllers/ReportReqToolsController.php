<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Readers\ReportReqToolsReader;
use App\Core\Export\ReportReqToolsExcel;

use Session;
use HelpMe;
use DB;

class ReportReqToolsController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "repreqtools"; //disetiap __construct controller harus ada
      $this->modulName = "Report Request Tools"; //disetiap __construct controller harus ada
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
    $pos = "index";
      $this->theme["page"] = 'index'; //disetiap class dan function controller harus ada
      $first_date = (isset($_REQUEST['first_date']) ? $_REQUEST['first_date'] : '');
      $second_date = (isset($_REQUEST['second_date']) ? $_REQUEST['second_date'] : '');
      $sf = (isset($_GET['sf']) ? $_GET['sf'] : '');
      $sq = (isset($_GET['sq']) ? $_GET['sq'] : '');
      $bts = (isset($_GET['bts']) ? $_GET['bts'] : '');

      try {
        $alert = "";

        $reader = new ReportReqToolsReader($request);
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
      return (new ReportReqToolsExcel($request))->download('Report Request New Tools.xls');
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
    try {

      $reader = new ReportReqToolsReader($request);
      $data = $reader->read();

      return view('layouts.print', ['data' => $data, 'modul' => $this->modul, 'first_date' => $first_date, 'second_date' => $second_date, 'sf' => $sf, 'sq' => $sq]);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }
}
