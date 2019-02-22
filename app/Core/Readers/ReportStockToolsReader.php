<?php
namespace App\Core\Readers;

use App\Tools;
use App\ToolsKaryawan;
use App\Barang;
use App\Core\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class ReportStockToolsReader implements Reader
{
    private $request;
    /** constructor, fungsinya untuk memudahkan passing variable dari controller */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /** method ini digunakan untuk mengeksekusi query */
    public function read()
    {

      $req = $this->request;
      $batas = (isset($req->bts) && !empty($req->bts) ? $req->bts : '10');
      $sq = (isset($req->sq) ? $req->sq : '');

      $project = $this->getByProject();
      $type = $this->getByType();
      $city = array();
      // dd($type);
      foreach($type AS $ty){
        $city[$ty->id] = $this->getByCityByType($ty->id);
      }

      $jml = array();
      foreach($type AS $ty){
        $jmlOffice[$ty->id] = $this->getJmlOfficeByType($ty->id);
        foreach($project AS $pr){
          $jmlByProjectType[$ty->id][$pr->id] = $this->getJmlByProjectType($pr->id, $ty->id);
        }

        foreach($city[$ty->id] AS $ct){
          foreach($project AS $pr){
            $jml[$ty->id][$ct->id][$pr->id] = $this->getJml($pr->id, $ct->id, $ty->id);
          }
        }
      }

      return array('project'=>$project, 'type'=>$type, 'city'=>$city, 'jml'=>$jml, 'jmlByProjectType'=>$jmlByProjectType, 'jmlOffice'=>$jmlOffice);
    }

    private function getJml($project_id, $city_id, $barang_id)
    {
      $data = new ToolsKaryawan();
      $data = $data->join('allho_activities AS b', 'tools_karyawan.allho_activities_id', '=', 'b.id')
                   ->join('project AS c', 'b.project_id', '=', 'c.id')
                   ->join('tools AS d', 'tools_karyawan.tools_id', '=', 'd.id')
                   ->join('barang AS e', 'd.barang_id', '=', 'e.id')
                   ->join('karyawan AS f', 'tools_karyawan.karyawan_id', '=', 'f.id')
                   ->join('city AS g', 'f.assignmentarea_id', '=', 'g.id')
                   ->where('c.id', $project_id)->where('g.id', $city_id)->where('e.id', $barang_id)->count();
      return $data;
    }

    private function getJmlByProjectType($project_id, $barang_id)
    {
      $data = new ToolsKaryawan();
      $data = $data->join('allho_activities AS b', 'tools_karyawan.allho_activities_id', '=', 'b.id')
                   ->join('project AS c', 'b.project_id', '=', 'c.id')
                   ->join('tools AS d', 'tools_karyawan.tools_id', '=', 'd.id')
                   ->join('barang AS e', 'd.barang_id', '=', 'e.id')
                   ->join('karyawan AS f', 'tools_karyawan.karyawan_id', '=', 'f.id')
                   ->join('city AS g', 'f.assignmentarea_id', '=', 'g.id')
                   ->where('c.id', $project_id)->where('e.id', $barang_id)->count();
      return $data;
    }

    private function getJmlOfficeByType($barang_id)
    {
      $data = new Tools();
      $data = $data->join('barang AS e', 'tools.barang_id', '=', 'e.id')
                   ->whereNull('tools.deleted_at')
                   ->whereNotIn('tools.id', DB::table('tools_karyawan')->pluck('tools_id'))
                   ->where('e.id', $barang_id)->count();
      return $data;
    }

    private function getByProject()
    {
      $req = $this->request;
      $data = ToolsKaryawan::join('allho_activities AS b', 'tools_karyawan.allho_activities_id', '=', 'b.id')->join('project AS c', 'b.project_id', '=', 'c.id')->groupBy('c.id', 'c.name')->select('c.id', 'c.name')->get();

      // dd($data);
      return $data;
    }

    private function getByType()
    {
      $req = $this->request;
      $data = Barang::select('id', 'type', 'name')->orderBy('name', 'asc')->get();

      // dd($data);
      return $data;
    }

    private function getByCityByType($barang_id)
    {
      $req = $this->request;
      $data = ToolsKaryawan::join('karyawan AS b', 'tools_karyawan.karyawan_id', '=', 'b.id')
                            ->join('city AS c', 'b.assignmentarea_id', '=', 'c.id')
                            ->join('tools AS d', 'tools_karyawan.tools_id', '=', 'd.id')
                            ->where('d.barang_id', $barang_id)
                            ->groupBy('c.id', 'c.name')
                            ->select('c.id', 'c.name')->get();
      return $data;
    }
}
