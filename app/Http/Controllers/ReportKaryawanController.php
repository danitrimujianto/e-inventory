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

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function add(Request $request)
  {
      $pos = "add";
      $this->theme["page"] = 'add'; //disetiap class dan function controller harus ada
      $this->returnData['theme'] = $this->theme;
      $this->returnData['data'] = "";

      try{
        $reader = new DivisionReader($request);
        $dDivision = $reader->read();
        $this->returnData['dDivision'] = $dDivision;

        $reader = new BarangReader($request);
        $dBarang = $reader->read();
        $this->returnData['dBarang'] = $dBarang;

        return view('home', $this->returnData);
      }catch(\Exception $e){
        $msg = $this->resultException($e, $pos);
        return dd($msg);
      }
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
      $handler = new AddToolsHandler($request);
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
      $reader = new GetToolsReader($id);
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
  public function edit(Request $request, $id)
  {
    $pos = "edit";
    $this->theme["page"] = 'edit'; //disetiap class dan function controller harus ada
    $this->returnData['theme'] = $this->theme;
    $this->returnData['data'] = "";

    try {
      $reader = new GetToolsReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;

      $reader = new DivisionReader($request);
      $dDivision = $reader->read();
      $this->returnData['dDivision'] = $dDivision;

      $reader = new BarangReader($request);
      $dBarang = $reader->read();
      $this->returnData['dBarang'] = $dBarang;

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
      $handler = new UpdateToolsHandler($request);
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
      $handler = new DeleteToolsHandler($id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

   public function list(Request $request)
   {
     $pos = "list";
     try {
       $reader = new ToolsReader($request);
       $data = $reader->read();
       $this->returnData['data'] = $data;

       return view('moduls.tools.list', $this->returnData);
     } catch (\Exception $e) {
       $msg = $this->resultException($e, $pos);
       return dd($msg);
     }
   }

    public function listMutasi(Request $request)
    {
      $pos = "listMutasi";
      try {
        $reader = new ToolsMutasiReader($request);
        $data = $reader->read();
        // dd($data);
        return response()->json($data);
        // return $data;
      } catch (\Exception $e) {
        $msg = $this->resultException($e, $pos);
        return dd($msg);
      }
    }

  public function selectData(Request $request)
  {
    $pos = "selectData";
    try {
      $reader = new SelectToolsReader($request);
      $data = $reader->read();
      // dd($data);
      return response()->json($data);
      // return $data;
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }

 public function search(Request $request)
 {
   $pos = "search";
   try {
     $reader = new SearchToolsReader($request);
     $data = $reader->read();

     return response()->json($data);
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
   try {

     $reader = new ReportKaryawanPrint($request);
     $data = $reader->read();

     return view('layouts.print', ['data' => $data, 'modul' => $this->modul]);
   } catch (\Exception $e) {
     $msg = $this->resultException($e, $pos);
     return dd($msg);
   }
 }
}
