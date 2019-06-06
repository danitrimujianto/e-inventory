<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Handlers\AddServiceHandler;
use App\Core\Handlers\UpdateServiceHandler;
use App\Core\Handlers\DeleteServiceHandler;
use App\Core\Handlers\AcceptServiceHandler;
use App\Core\Handlers\RejectServiceHandler;
use App\Core\Handlers\FinishServiceHandler;
use App\Core\Readers\ServiceReader;
use App\Core\Readers\GetServiceReader;

//others table
use App\Core\Readers\DeliveryReader;
use App\Core\Readers\GoodsConditionReader;
use App\Core\Readers\KaryawanReader;
use App\Core\Readers\ProjectReader;
use App\Core\Readers\AreaReader;


use Session;
use HelpMe;
use DB;

class ServiceController extends ApplicationController
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->modul = "service"; //disetiap __construct controller harus ada
      $this->modulName = "Maintenance"; //disetiap __construct controller harus ada
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
        $reader = new ServiceReader($request);
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

        $reader = new GoodsConditionReader($request);
        $dCondition = $reader->read();
        $this->returnData['dCondition'] = $dCondition;

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
      $handler = new AddServiceHandler($request);
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
      $reader = new GetServiceReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;

      $reader = new GoodsConditionReader($request);
      $dCondition = $reader->read();
      $this->returnData['dCondition'] = $dCondition;

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
      $reader = new GetServiceReader($id);
      $data = $reader->read();
      $this->returnData['data'] = $data;

      $reader = new GoodsConditionReader($request);
      $dCondition = $reader->read();
      $this->returnData['dCondition'] = $dCondition;

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
      $handler = new UpdateServiceHandler($request);
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
      $handler = new DeleteServiceHandler($id);
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
      $handler = new AcceptServiceHandler($id);
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
      $handler = new RejectServiceHandler($request, $id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }

  public function finish(Request $request, $id)
  {
    $pos = "Finish";
    try {
      $handler = new FinishServiceHandler($request, $id);
      $data = $handler->handle();
      $this->createAlert("info", $pos." Succeeded");

      return redirect($this->modul);
    } catch (\Exception $e) {
      $msg = $this->resultException($e, $pos);
      return redirect($this->modul);
    }
  }
}
