<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Handlers\AddToolsHandler;
use App\Core\Handlers\UpdateToolsHandler;
use App\Core\Handlers\DeleteToolsHandler;
use App\Core\Readers\ReportKaryawanReader;
use App\Core\Readers\SearchToolsReader;
use App\Core\Readers\ToolsMutasiReader;
use App\Core\Readers\GetToolsReader;
use App\Core\Readers\SelectToolsReader;

//others table
use App\Core\Readers\DivisionReader;
use App\Core\Readers\BarangReader;
use App\Core\Export\ReportKaryawanExcel;
use App\Core\Export\ReportKaryawanPrint;


use Session;
use HelpMe;
use DB;

class ReportKaryawanController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "repkaryawan"; //disetiap __construct controller harus ada
      $this->modulName = "Report Employee"; //disetiap __construct controller harus ada
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
      $alert = "";
      $this->theme["page"] = 'index'; //disetiap class dan function controller harus ada
      $sf = (isset($_GET['sf']) ? $_GET['sf'] : '');
      $sq = (isset($_GET['sq']) ? $_GET['sq'] : '');
      $bts = (isset($_GET['bts']) ? $_GET['bts'] : '');

      try {
        $reader = new ReportKaryawanReader($request);
        $data = $reader->read();

        if(session()->get('procMsg')){
          $st = session()->get('procMsg');
          $alert = HelpMe::procMsg($st);
          session()->forget('procMsg');
        }

        $this->returnData['theme'] = $this->theme;
        $this->returnData['data'] = $data;
        $this->returnData['sf'] = $sf;
        $this->returnData['sq'] = $sq;
        $this->returnData['bts'] = $bts;
        $this->returnData['alert'] = $alert;

        return view('home', $this->returnData);
      } catch (\Exception $e) {
        $msg = $this->resultException($e, $pos);
        return dd($msg);
      }
  }

 public function excel(Request $request)
 {
   $pos = "Export Excel";
   try {
     return (new ReportKaryawanExcel($request))->download('Report Employee.xls');
     // return Excel::download(new AlatKaryawanExcel($request), 'alat-karyawan.xlsx');
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

     $reader = new ReportKaryawanReader($request, $isExport);
     $data = $reader->read();

    return view('layouts.print', ['data' => $data, 'modul' => $this->modul, 'first_date' => $first_date, 'second_date' => $second_date, 'sf' => $sf, 'sq' => $sq]);
   } catch (\Exception $e) {
     $msg = $this->resultException($e, $pos);
     return dd($msg);
   }
 }
}
