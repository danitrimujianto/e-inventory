<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Handlers\AddKaryawanHandler;
use App\Core\Handlers\UpdateKaryawanHandler;
use App\Core\Handlers\DeleteKaryawanHandler;
use App\Core\Readers\KaryawanReader;
use App\Core\Readers\SearchKaryawanReader;
use App\Core\Readers\GetKaryawanReader;

//others table
use App\Core\Readers\DepartemenReader;
use App\Core\Readers\PositionReader;
use App\Core\Readers\ProjectReader;
use App\Core\Readers\AreaReader;
use App\Core\Readers\CityReader;


use Session;
use HelpMe;
use DB;

class KaryawanController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "karyawan"; //disetiap __construct controller harus ada
      $this->modulName = "Employee"; //disetiap __construct controller harus ada
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
        $reader = new KaryawanReader($request);
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
        $reader = new DepartemenReader($request);
        $dDepartemen = $reader->readData();
        $this->returnData['dDepartemen'] = $dDepartemen;

        $reader = new PositionReader($request);
        $dPosition = $reader->readData();
        $this->returnData['dPosition'] = $dPosition;

        $reader = new ProjectReader($request);
        $dProject = $reader->readData();
        $this->returnData['dProject'] = $dProject;

        $reader = new AreaReader($request);
        $dArea = $reader->readData();
        $this->returnData['dArea'] = $dArea;

        $reader = new CityReader($request);
        $dCity = $reader->readData();
        $this->returnData['dCity'] = $dCity;

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
      $handler = new AddKaryawanHandler($request);
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
  public function show(Request $request, $id)
  {
    $pos = 'view';
    $this->theme["page"] = 'view'; //disetiap class dan function controller harus ada
    $this->returnData['theme'] = $this->theme;
    $this->returnData['data'] = "";

    try {
      $reader = new GetKaryawanReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;

      $reader = new DepartemenReader($request);
      $dDepartemen = $reader->readData();
      $this->returnData['dDepartemen'] = $dDepartemen;

      $reader = new PositionReader($request);
      $dPosition = $reader->readData();
      $this->returnData['dPosition'] = $dPosition;

      $reader = new ProjectReader($request);
      $dProject = $reader->readData();
      $this->returnData['dProject'] = $dProject;

      $reader = new AreaReader($request);
      $dArea = $reader->readData();
      $this->returnData['dArea'] = $dArea;

      $reader = new CityReader($request);
      $dCity = $reader->readData();
      $this->returnData['dCity'] = $dCity;

      return view('home', $this->returnData);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
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
      $reader = new GetKaryawanReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;
      
      $reader = new DepartemenReader($request);
      $dDepartemen = $reader->readData();
      $this->returnData['dDepartemen'] = $dDepartemen;

      $reader = new PositionReader($request);
      $dPosition = $reader->readData();
      $this->returnData['dPosition'] = $dPosition;

      $reader = new ProjectReader($request);
      $dProject = $reader->readData();
      $this->returnData['dProject'] = $dProject;

      $reader = new AreaReader($request);
      $dArea = $reader->readData();
      $this->returnData['dArea'] = $dArea;

      $reader = new CityReader($request);
      $dCity = $reader->readData();
      $this->returnData['dCity'] = $dCity;

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
      $handler = new UpdateKaryawanHandler($request);
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
      $handler = new DeleteKaryawanHandler($id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  public function search(Request $request)
  {
    $pos = "search";
    try {
      $reader = new SearchKaryawanReader($request);
      $data = $reader->read();

      return response()->json($data);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return dd($msg);
    }
  }
}
