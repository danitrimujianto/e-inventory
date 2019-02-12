<?php
namespace App\Core\Export;

use App\Tools;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class ReportToolsExcel implements FromView
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->request  = $request;
        $this->modul    = 'reptools';
    }

    public function view(): View
    {
      $req = $this->request;
      $first_date = (isset($req->first_date) ? $req->first_date : '');
      $second_date = (isset($req->second_date) ? $req->second_date : '');

      $data = Tools::whereNull('karyawan_id');
      if(!empty($sq))
      {
        $data = $data->where($req->sf, 'like', '%'.$req->sq.'%');
      }
      $data = $data->get();

      return view('layouts.print', [
          'data' => $data,
          'modul' => $this->modul
      ]);
    }

}
