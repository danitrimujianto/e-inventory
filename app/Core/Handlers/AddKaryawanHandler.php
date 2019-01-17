<?php
namespace App\Core\Handlers;

use App\Karyawan;
use App\User;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class AddKaryawanHandler implements Handler
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $request = $this->request;
        $valid = $this->checkFirst($request);
        if(!$valid[1])
        {
          return abort(500, $valid[0]);
        }else{
          $data = $this->saveDB($request);
          return $data;
        }
    }

    private function saveDB($request)
    {
        $path = "";

        $TipeUser = '4';
        $PassUser = 'sinergi123';

        $tab = new Karyawan();
        $tab->id_karyawan = $request->id_karyawan;
        $tab->name = $request->name;
        $tab->departemen_id = $request->departemen_id;
        $tab->position_id = $request->position_id;
        $tab->project_id = $request->project_id;
        $tab->homebasearea_id = $request->homebasearea_id;
        $tab->assignmentarea_id = $request->assignmentarea_id;
        $tab->phone_number = $request->phone_number;
        $tab->email = $request->email;
        $tab->status = $request->status;
        $tab->save();

        $AddUser = new User();
        $AddUser->usertype_id = $TipeUser;
        $AddUser->name = $request->name;
        $AddUser->email = $request->email;
        $AddUser->karyawan_id = $tab->id;
        $AddUser->password = bcrypt($PassUser);
        $AddUser->save();

        return $tab;
    }

    private function checkFirst($request){
      $msg = '';
      $cek = Karyawan::where('email', $request->email)->first();
      if(!empty($cek->email))
      {
        $msg = 'Duplicate Email';
      }

      if($msg != '')
        return array($msg, false);
      else
        return array($msg, true);
    }
}
