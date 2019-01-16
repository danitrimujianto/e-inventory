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

class AddUserHandler implements Handler
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
        $path = "";

        $kar = Karyawan::where('email', $request->email)->where('status', 'Aktif')->first();
        $karyawan_id = ($kar) ? $kar->id : null;

        $tab = new User();
        $tab->usertype_id = $request->usertype_id;
        $tab->name = $request->name;
        $tab->email = $request->email;
        $tab->karyawan_id = $karyawan_id;
        $tab->request_tools = $request->request_tools;
        $tab->password = bcrypt($request->password);
        $tab->save();

        return $tab;
    }
}
