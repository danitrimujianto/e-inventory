<?php
namespace App\Core\Export;

use App\Karyawan;
use App\Core\Readers\ReportKaryawanReader;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;
use HelpMe;

class ReportKaryawanExcel implements FromView
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->request  = $request;
        $this->modul    = 'repkaryawan';
    }

    public function view(): View
    {
      $req = $this->request;
      $first_date = (isset($req->first_date) ? $req->first_date : '');
      $second_date = (isset($req->second_date) ? $req->second_date : '');
      $sq = (isset($req->sq) ? $req->sq : '');
      $sf = (isset($req->sf) ? $req->sf : '');
      $isExport = true;

      $reader = new ReportKaryawanReader($req, $isExport);
      $data = $reader->read();

      return view('layouts.print', [
          'data' => $data,
          'modul' => $this->modul,
          'first_date' => $first_date,
          'second_date' => $second_date,
          'sf' => $sf,
          'sq' => $sq
      ]);
    }

}
