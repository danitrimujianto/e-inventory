<?php
namespace App\Core\Export;

use App\ToolsKaryawan;
use App\Karyawan;
use App\Core\Readers\AlatKaryawanReader;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class OtherEmployeeToolsExcel implements FromView
{
    use Exportable;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
      $req = $this->request;

      $data = new ToolsKaryawan;

      $data = $data->where('karyawan_id', '!=', Auth::user()->karyawan_id)->whereHas('karyawan', function($q) use($assignmentarea_id){
        $q->where('assignmentarea_id', $assignmentarea_id);
      });

      if(!empty($sq))
      {
        if($sf == "item")
        {
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('item', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == "code_tools")
        {
          $data = $data->whereHas('tools', function($q) use ($sq){
            $q->where('code', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == "karyawan")
        {
          $data = $data->whereHas('karyawan', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }
        elseif($sf == "project")
        {
          $data = $data->whereHas('project', function($q) use ($sq){
            $q->where('name', 'like', '%'.$sq.'%');
          });
        }
      }

      $data = $data->orderBy('id','desc')->get();

        return view('layouts.print', [
            'data' => $data,
            'modul' => 'alatkaryawan'
        ]);
    }

}
