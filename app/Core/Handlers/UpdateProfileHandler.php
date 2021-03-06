<?php
namespace App\Core\Handlers;

use App\User;
use App\Karyawan;
use App\Core\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;
use Storage;
class UpdateProfileHandler implements Handler
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $request = $this->request;
        $data = $this->saveDB($request);
        return $data;
    }

    private function saveDB($request)
    {
        $id = $request->id;

        $karyawan_id = (!empty(Auth::user()->karyawan_id) ? Auth::user()->karyawan_id : null);

        if($request->file('avatar')){
          if(Storage::exists($request->file_lama)){ Storage::delete($request->file_lama); }
          $info = pathinfo($request->file('avatar')->getClientOriginalName());
          $ext = $info['extension'];
          /* proses upload file */
          $avatarImg = $request->file('avatar');
          $avatar = $avatarImg->getClientOriginalName();
          $avatar = 'avatar_'.bcrypt($request->id).str_replace('/','',$avatar);
          $PathAvatar = $avatarImg->storeAs('avatars', $avatar);
        }else{
          $PathAvatar = $request->file_lama;
        }

        $tab = User::find($id);
        $tab->name = $request->name;
        $tab->email = $request->email;
        $tab->avatar = $PathAvatar;
        if(!empty($request->password))
          $tab->password = bcrypt($request->password);

        $tab->save();

        if(!empty($karyawan_id)){
          $karyawan                           = Karyawan::find($karyawan_id);
          $karyawan->name                     = $request->name;
          $karyawan->phone_number             = $request->phone_number;
          $karyawan->email                    = $request->email;
          $karyawan->project_id               = $request->project_id;
          $karyawan->homebasearea_id          = $request->homebasearea_id;
          $karyawan->assignmentarea_id        = $request->assignmentarea_id;
          $karyawan->save();
        }

        return $tab;
    }
}
