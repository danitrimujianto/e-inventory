<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Handlers\AddHandoverReturHandler;
use App\Core\Handlers\UpdateHandoverReturHandler;
use App\Core\Handlers\DeleteHandoverReturHandler;
use App\Core\Handlers\AcceptHandoverReturHandler;
use App\Core\Handlers\CancelHandoverReturHandler;
use App\Core\Handlers\RejectHandoverReturHandler;
use App\Core\Readers\HandoverReturReader;
use App\Core\Readers\GetHandoverReturReader;

//others table
use App\Core\Readers\DeliveryReader;
use App\Core\Readers\GoodsConditionReader;
use App\Core\Readers\KaryawanReader;
use App\Core\Readers\ProjectReader;
use App\Core\Readers\AreaReader;
use App\Core\Readers\GetToolsReader;


use Session;
use HelpMe;
use DB;

class HandoverReturController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "horetur"; //disetiap __construct controller harus ada
      $this->modulName = "Handover Retur Tools"; //disetiap __construct controller harus ada
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
        $reader = new HandoverReturReader($request);
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
        $reader = new DeliveryReader($request);
        $dDelivery = $reader->read();
        $this->returnData['dDelivery'] = $dDelivery;

        $reader = new GoodsConditionReader($request);
        $dCondition = $reader->read();
        $this->returnData['dCondition'] = $dCondition;

        $reader = new KaryawanReader($request);
        $dKaryawan = $reader->read();
        $this->returnData['dKaryawan'] = $dKaryawan;

        $reader = new ProjectReader($request);
        $dProject = $reader->read();
        $this->returnData['dProject'] = $dProject;

        $reader = new AreaReader($request);
        $dArea = $reader->read();
        $this->returnData['dArea'] = $dArea;

        $dToolBulk = array();
        if(isset($request->idTools)){
          foreach($request->idTools AS $k=>$v){
            $reader = new GetToolsReader($v);
            $dToolBulk[] = $reader->read();
          }
        }
        $this->returnData['dToolsBulk'] = $dToolBulk;

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
      $handler = new AddHandoverReturHandler($request);
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
      $reader = new GetHandoverReturReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;

      $reader = new DeliveryReader($request);
      $dDelivery = $reader->read();
      $this->returnData['dDelivery'] = $dDelivery;

      $reader = new GoodsConditionReader($request);
      $dCondition = $reader->read();
      $this->returnData['dCondition'] = $dCondition;

      $reader = new KaryawanReader($request);
      $dKaryawan = $reader->read();
      $this->returnData['dKaryawan'] = $dKaryawan;

      $reader = new ProjectReader($request);
      $dProject = $reader->read();
      $this->returnData['dProject'] = $dProject;

      $reader = new AreaReader($request);
      $dArea = $reader->read();
      $this->returnData['dArea'] = $dArea;

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
      $reader = new GetHandoverReturReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;

      $reader = new DeliveryReader($request);
      $dDelivery = $reader->read();
      $this->returnData['dDelivery'] = $dDelivery;

      $reader = new GoodsConditionReader($request);
      $dCondition = $reader->read();
      $this->returnData['dCondition'] = $dCondition;

      $reader = new KaryawanReader($request);
      $dKaryawan = $reader->read();
      $this->returnData['dKaryawan'] = $dKaryawan;

      $reader = new ProjectReader($request);
      $dProject = $reader->read();
      $this->returnData['dProject'] = $dProject;

      $reader = new AreaReader($request);
      $dArea = $reader->read();
      $this->returnData['dArea'] = $dArea;

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
      $handler = new UpdateHandoverReturHandler($request);
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
      $handler = new DeleteHandoverReturHandler($id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

 public function accept($id)
 {
   $pos = "accept";
   try {
     $handler = new AcceptHandoverReturHandler($id);
     $data = $handler->handle();
     $this->createAlert("info", $pos." Succeeded");

     return redirect($this->modul);
   } catch (\Exception $e) {
     $msg = $this->resultException($e, $pos);
     return redirect($this->modul);
   }
 }

  public function cancel(Request $request, $id)
  {
    $pos = "Cancel";
    try {
      $handler = new CancelHandoverReturHandler($request, $id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

   public function reject(Request $request, $id)
   {
     $pos = "Reject";
     try {
       $handler = new RejectHandoverReturHandler($request, $id);
       $data = $handler->handle();
       $this->createAlert("info", $pos." Succeeded");

       return redirect($this->modul);
     } catch (\Exception $e) {
       $msg = $this->resultException($e, $pos);
       return redirect($this->modul);
     }
   }
}
