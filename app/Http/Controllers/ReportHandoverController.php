<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Readers\ReportHandoverReader;
use App\Core\Export\ReportHandoverExcel;

use Session;
use HelpMe;
use DB;

class ReportHandoverController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "rephandover"; //disetiap __construct controller harus ada
      $this->modulName = "Report Handover"; //disetiap __construct controller harus ada
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
      $this->theme["page"] = 'index'; //disetiap class dan function controller harus ada
      $first_date = (isset($_GET['first_date']) ? $_GET['first_date'] : '');
      $second_date = (isset($_GET['second_date']) ? $_GET['second_date'] : '');
      $bts = (isset($_GET['bts']) ? $_GET['bts'] : '');

      try {
        $alert = "";

        $reader = new ReportHandoverReader($request);
        $data = $reader->read();

        $this->returnData['theme'] = $this->theme;
        $this->returnData['first_date'] = $first_date;
        $this->returnData['second_date'] = $second_date;
        $this->returnData['bts'] = $bts;
        $this->returnData['data'] = $data;
        $this->returnData['alert'] = $alert;

        return view('home', $this->returnData);
      } catch (\Exception $e) {
        $msg = $this->resultException($e, $pos);
        return redirect($this->modul);
      }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function add()
  {
      $this->theme["page"] = 'add'; //disetiap class dan function controller harus ada
      $this->returnData['theme'] = $this->theme;
      $this->returnData['data'] = "";

      return view('home', $this->returnData);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $pos = "add";
    try {
      $handler = new AddVendorHandler($request);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $this->theme["page"] = 'view'; //disetiap class dan function controller harus ada
    $this->returnData['theme'] = $this->theme;
    $this->returnData['data'] = "";

    try {
      $reader = new GetVendorReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;
      return view('home', $this->returnData);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $pos = "edit";
    $this->theme["page"] = 'edit'; //disetiap class dan function controller harus ada
    $this->returnData['theme'] = $this->theme;
    $this->returnData['data'] = "";

    try {
      $reader = new GetVendorReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;
      return view('home', $this->returnData);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $pos = "edit";
    try {
      //dd($request);
      $handler = new UpdateVendorHandler($request);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $pos = "delete";
    try {
      $handler = new DeleteVendorHandler($id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  public function excel(Request $request)
  {
    $pos = "Export Excel";
    try {
      return (new ReportHandoverExcel($request))->download('Report Handover.xls');
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }

  public function print(Request $request)
  {
    $pos = "Print";
    try {

      $reader = new ReportHandoverReader($request);
      $data = $reader->read();

      return view('layouts.print', ['data' => $data, 'modul' => 'rephandover']);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }
}
