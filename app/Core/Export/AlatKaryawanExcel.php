<?php
namespace App\Core\Export;

use App\ToolsKaryawan;
use App\Core\Readers\AlatKaryawanReader;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class AlatKaryawanExcel implements FromView
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
      $req = $this->request;

        $reader = new AlatKaryawanReader($req);
        $data = $reader->read();

        return view('layouts.print', [
            'data' => $data,
            'modul' => 'alatkaryawan'
        ]);
    }

}
