<?php
namespace App\Core\Libraries;

use Illuminate\Support\Facades\DB;

use Storage;

class FunctionGlobals {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function checkAktifData($obj) {
    	if($obj == "1"){
    		$ret = '<span class="badge bg-green">Aktif</span>';
    	}else{
    		$ret = '<span class="badge bg-red">Non Aktif</span>';
    	}

    	return $ret;
    }

    /****************************************************************
     ***** Fungsi untuk Menampilkan Highlight String Pencarian *******
     *****************************************************************/
    public static function HighLight($String, $Keyword){
      if($Keyword == null){
        return $String;
      }else{
        $chString	= str_split($String);
        $lenKey		= strlen($Keyword);
        $strResult	= $chString;

        for($i=0; $i<count($chString); $i++)
        {
          $strKey = "";
          for($a=$i; $a<($i+$lenKey); $a++)
          {
            if(!empty($chString[$a])){
              $strKey .= $chString[$a];
            }
          }

          if(strtolower($strKey) == strtolower($Keyword))
          {
            for($b=$i; $b<($i+$lenKey); $b++)
            {
              $strResult[$b] = "<b><font color='red'>".$chString[$b]."</font></b>";
            }
          }
        }

        return implode("", $strResult);
      }
    }

    public static function cekProcData($obj, $tipe="?")
    {
        if($tipe == "insert")
        {
            if($obj == true){
                $ket = "Data Berhasil Disimpan";
                $status = "callout-info";
            }else{
                $ket = "Data Gagal Disimpan";
                $status = "callout-danger";
            }
        }

        if($tipe == "update")
        {
            if($obj == true){
                $ket = "Data Berhasil Diedit";
                $status = "callout-info";
            }else{
                $ket = "Data Gagal Diedit";
                $status = "callout-danger";
            }
        }

        if($tipe == "delete")
        {
            if($obj == true)
            {
                $ket = "Data Berhasil Dihapus";
                $status = "callout-info";
            }
            else
            {
                $ket = "Data Gagal Dihapus";
                $status = "callout-danger";
            }
        }


        return session()->put("proc-error", ["status" => $status, "ket" => $ket]);
    }
    public static function createError($ket){
      $status = "callout-danger";
      return session()->put("proc-error", ["status" => $status, "ket" => $ket]);
    }
    public static function textFormat($obj){
      $ret = str_replace("\n", "<br>", $obj);
      return $ret;
    }
    public static function cariBulan($obj){
        switch($obj){
            case "1" : $bulan = "Januari"; break;
            case "2" : $bulan = "Februari"; break;
            case "3" : $bulan = "Maret"; break;
            case "4" : $bulan = "April"; break;
            case "5" : $bulan = "Mei"; break;
            case "6" : $bulan = "Juni"; break;
            case "7" : $bulan = "Juli"; break;
            case "8" : $bulan = "Agustus"; break;
            case "9" : $bulan = "September"; break;
            case "10" : $bulan = "Oktober"; break;
            case "11" : $bulan = "November"; break;
            case "12" : $bulan = "Desember"; break;
        }
        return $bulan;
    }

    public static function tgl_indo_to_sql($obj){

      if(!empty($obj)){
        $ex = explode("/", $obj);
        $hasil = $ex[2]."-".$ex[1]."-".$ex[0];
      }else{
        $hasil = "1900-01-01";
      }

      return $hasil;

    }

    public static function tgl_sql_to_indo($obj){

    $ex = explode("-", $obj);

    if(!empty($obj)){
      $hasil = $ex[2]."/".$ex[1]."/".$ex[0];
    }else{
      $hasil = "";
    }

    return $hasil;

    }

  public static function tgl_mysql($obj, $separator){

  	//ex: 07/07/2015
  	//$separator: /
    if(!empty($obj)){
    	$ex = explode($separator, $obj);
    	$tgl = $ex[2]."-".$ex[1]."-".$ex[0];
    }else{
      $tgl = "";
    }

  	return $tgl;
  }

  public static function convert_tgl_mysql($obj, $separator){

  	//ex: 2015-01-01
  	//return 01/01/2015 (garing di ambil dr separator)

  	$ex = explode("-", $obj);
    if(!empty($obj)){
  	   $tgl = $ex[2].$separator.$ex[1].$separator.$ex[0];
    }else{
      $tgl = "";
    }
  	return $tgl;
  }

  public static function convert_tgl_mysql_jam($obj, $separator){

  	//ex: 2015-01-01
  	//return 01/01/2015 (garing di ambil dr separator)

    if(!empty($obj)){
  	$pisah = explode(" ", $obj);
  	$ex = explode("-", $pisah[0]);
  	$tgl = $ex[2].$separator.$ex[1].$separator.$ex[0]." ".$pisah[1];
   }else{
     $tgl = "";
   }

  	return $tgl;
  }

  public static function convert_tgl_indo_jam($obj, $separator){

  	//ex: 2015-01-01
  	//return 01/01/2015 (garing di ambil dr separator)

    if(!empty($obj)){
  	$pisah = explode(" ", $obj);
  	$ex = explode("/", $pisah[0]);
  	$tgl = $ex[2].$separator.$ex[1].$separator.$ex[0]." ".$pisah[1];
   }else{
     $tgl = "";
   }

  	return $tgl;
  }

    public static function namahari($tanggal){

        //fungsi mencari namahari
        //format $tgl YYYY-MM-DD

        $tgl=substr($tanggal,8,2);
        $bln=substr($tanggal,5,2);
        $thn=substr($tanggal,0,4);

        $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));

        switch($info){
            case '0': return "Minggu"; break;
            case '1': return "Senin"; break;
            case '2': return "Selasa"; break;
            case '3': return "Rabu"; break;
            case '4': return "Kamis"; break;
            case '5': return "Jumat"; break;
            case '6': return "Sabtu"; break;
        };

    }

    public static function tgl_sql_to_indo2($obj){

        $ex = explode("-", $obj);

        $hasil = $ex[2]." ".self::cariBulan($ex[1])." ".$ex[0];

        return $hasil;

    }

    public static function hariTgl($tgl)
    {
        $hari = self::namahari($tgl);

        $ret = $hari.", ".self::tgl_sql_to_indo2($tgl);
        return $ret;
    }

    public static function menuList($parent=0,$permission=0){
        $html = "";
        $tb = new tb_menu;
        $dropdown = "";
        $dropdown_toggle = "";
        $dropdown_toggle2 = "";
        $url = "";
        $aktip = "";
        //dd($permission);
        $menu = $tb->where('parent','=',$parent)->where('soft_delete', '<>', '1')->get();
        $parent = $tb->where('id','=',$parent)->where('soft_delete', '<>', '1')->first();

          if(in_array($parent->id, $permission)){

          if(sizeof($menu)>0){
            if($parent->parent==0){
              $dropdown = "dropdown";
            }else{
              $dropdown = "dropdown-submenu";
            }
            $dropdown_toggle = "dropdown-toggle";
            $dropdown_toggle2 = "data-toggle='dropdown'";
            $url = "#";
          }else{
            $url = "/".$parent->param;
          }
          if(isset(app()->view->getSections()[$parent->param])){ $aktip = "active"; }

          $html .= "<li class='$dropdown $aktip'>";
          $html .= "<a href='".url($url)."' class='$dropdown_toggle' $dropdown_toggle2>".$parent->nama_menu;
          if(sizeof($menu)>0){
            if($parent->parent==0){ $html .= "<span class='caret'></span>"; }
          }
          $html .= "</a>";
          if(sizeof($menu)>0){
            $html .= "<ul class='dropdown-menu' role='menu'>";
                foreach($menu AS $k){
                  $html .= self::menuList($k->id,$permission);
                }
            $html .= "</ul>";
          }
          $html .= "</li>";
        }
        return $html;
    }

    public static function menuListTable($parent=0,$permission=0,$act=0){
        $html = "";
        $tb = new tb_menu;
        $indentDefault = 20;
        $checked_tambah = "";
        $checked_ubah = "";
        $checked_hapus = "";
        $checked_lihat = "";
        $checked_all = "";

        $menu = $tb->where('parent','=',$parent)->where('soft_delete', '<>', '1')->get();
        $parent = $tb->where('id','=',$parent)->where('soft_delete', '<>', '1')->first();
        $textIndent = ($indentDefault*$parent->tingkatan);
        $html .= "<tr>";
        $html .= "<td style=' text-indent: ".$textIndent."px;'><input type='hidden' name='id_menu[]' value='".$parent->id."' >";
        $html .= $parent->nama_menu;
        $html .= "</td>";
        if(sizeof($menu)<=0){
            if($act == "edit"){
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["tambah"]) && $permission[$parent->id]["tambah"] == "1"){
                    $checked_tambah = "checked";
                }
                $html .= "<input type='checkbox' name='tambah[".$parent->id."]' class='check".$parent->id." cer' $checked_tambah value='".$parent->id."'>";
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["ubah"]) && $permission[$parent->id]["ubah"] == "1") {
                    $checked_ubah = "checked";
                }
                $html .= "<input type='checkbox' name='ubah[" . $parent->id . "]' class='check".$parent->id . " cer' $checked_ubah value='" . $parent->id . "'>";
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["hapus"]) && $permission[$parent->id]["hapus"] == "1") {
                    $checked_hapus = "checked";
                }
                $html .= "<input type='checkbox' name='hapus[" . $parent->id . "]' class='check" . $parent->id . " cer' $checked_hapus value='" . $parent->id . "'>";
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["lihat"]) && $permission[$parent->id]["lihat"] == "1") {
                    $checked_lihat = "checked";
                }
                $html .= "<input type='checkbox' name='lihat[" . $parent->id . "]' class='check" . $parent->id . " cer' $checked_lihat value='" . $parent->id . "'>";
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if($checked_tambah == "checked" && $checked_ubah == "checked" && $checked_hapus == "checked" && $checked_lihat == "checked"){
                  $checked_all = "checked";
                }
                $html .= "<input type='checkbox' class='all-check' id='all-check".$parent->id."' name='all' $checked_all value='".$parent->id."'>";
                $html .= "</td>";
            }else{

                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["tambah"]) && $permission[$parent->id]["tambah"] == "1"){
                    $html .= "<i class='fa fa-check-square'></i>";
                }
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["ubah"]) && $permission[$parent->id]["ubah"] == "1") {
                    $html .= "<i class='fa fa-check-square'></i>";
                }
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["hapus"]) && $permission[$parent->id]["hapus"] == "1") {
                    $html .= "<i class='fa fa-check-square'></i>";
                }
                $html .= "</td>";
                $html .= "<td style=' width: 15%; text-align: center;'>";
                if(isset($permission[$parent->id]["lihat"]) && $permission[$parent->id]["lihat"] == "1") {
                    $html .= "<i class='fa fa-check-square'></i>";
                }
                $html .= "</td>";
                if($act == "edit"){
                    $html .= "<td style=' width: 15%; text-align: center;'>";
                    $html .= "<input type='checkbox' class='all-check' name='all' value='".$parent->id."'>";
                    $html .= "</td>";
                }
            }
        }
        $html .= "</tr>";
        if(sizeof($menu)>0){
            foreach($menu AS $k){
                $html .= self::menuListTable($k->id,$permission,$act);
            }
        }
        return $html;
    }

    public static function menuPermission($id_userrole=0,$parent=0){
      if(empty($parent)){
        //$id_userrole = 1;
        $s1 = DB::table("tb_permissions AS a")->leftJoin("tb_menus AS b", "a.id_menu", "=", "b.id")->where("a.id_userrole", $id_userrole)->where("b.soft_delete", "<>", "1")->select("b.*")->get();
        foreach($s1 AS $dat1){
          $permission[] = $dat1->id;
          if($dat1->tingkatan > 0){
            $permission[] = self::menuPermission($id_userrole,$dat1->parent);
          }
        }
      }else{
        $s2 = DB::table("tb_menus")->where("id", $parent)->where("soft_delete", "<>", "1")->first();
        if($s2->tingkatan > 0){
          $permission[] = $s2->id;
          //if($s2->tingkatan > 0){
          $permission[] = self::menuPermission($id_userrole,$s2->parent);
          //}
        }else{
          $permission = $s2->id;
        }
      }
      return $permission;
    }

    public static function menuPermission2($id_userrole=0,$parent=0){
        //$id_userrole = 1;
        $no="";
        $s1 = DB::table("tb_permissions AS a")->leftJoin("tb_menus AS b", "a.id_menu", "=", "b.id")->where("a.id_userrole", $id_userrole)->where("b.soft_delete", "<>", "1")->select("b.*")->get();
        foreach($s1 AS $dat1){
          $permission[] = $dat1->id;
          if($dat1->tingkatan > 0){
            $no = 0;
            for($i = ($dat1->tingkatan-1); $i >= 0; $i--){
              $no++;
              if($no == 1){
                $parent = $dat1->parent;
              }else{
                $parent = $s2->parent;
              }
              $s2 = DB::table("tb_menus")->where("id", $parent)->where("soft_delete", "<>", "1")->first();
              $permission[] = $s2->id;
            }
          }
        }

      return $permission;
    }

    public static function cost2($angka2)
    {
      if(!empty($angka2)){
      $nilai2 = number_format($angka2,0,".",",");
    }else{
      $nilai2 = "0";
    }
      return $nilai2;
    }

    public static function cost($angka2)
    {
      if(!empty($angka2)){
      $nilai2 = number_format($angka2,0,".",".");
      }else{
        $nilai2 = "";
      }
      return $nilai2;
    }

    public static function labelStatusOrder($obj)
    {
      if($obj == "Create" || $obj == "Waiting Payment" || $obj == "On Progress" || $obj == "Delivery")
      { $bg = "bg-yellow"; }
      elseif($obj == "Cancel")
      { $bg = "bg-red"; }
      elseif($obj == "Confirm")
      { $bg = "bg-blue"; }
      elseif($obj == "Recieved")
      { $bg = "bg-green"; }

      return "<span class='badge ".$bg."'>".$obj."</span>";
    }

    public static function normalisasiNilai($obj){
      $ret = str_replace(",", "", str_replace(".", "", $obj));
      return $ret;
    }

    public static function diskonView($obj)
    {
      if(strlen($obj) <= "2")
      {
        return $obj."%";
      }else{
        return self::cost($obj);
      }
    }

    public static function nominalSql($obj)
    {
      return str_replace(".", "", $obj);
    }

    public static function nominalSql2($obj)
    {
      return str_replace(",", "", $obj);
    }

    public static function procMsg($status)
    {

      $alert = '<div class="alert alert-'.$status['status'].' alert-dismissible" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4 style="padding:0;margin:0;"><i class="icon fa '.self::statusIcon($status['status']).'"></i> '.$status['msg'].'</h4></div>';
      return $alert;
    }

    public static function statusIcon($status)
    {
      $icon = "";

      if($status == "danger")
      {  $icon = "fa-remove"; }
      else
      { $icon = "fa-check"; }

      return $icon;
    }

    public function checkProc($data, $pos, $ket = NULL)
    {
      if($data)
      {
        return array("status"=>"success", "msg"=>$pos." Success");
      }else{
        return array("status"=>"danger", "msg"=>$ket);
      }
    }

    public static function normalText($obj)
    {
      return str_replace(",", "", $obj);
    }

    public static function normalNumber($obj)
    {
      $obj = (empty($obj) ? "0" : $obj);
      return str_replace(",", "", str_replace(".", "", $obj));
    }

    public static function createThumbnail($image_name,$new_width,$new_height,$uploadDir,$moveToDir)
    {
        $path = $uploadDir . '/' . $image_name;

        $mime = getimagesize($path);

        if($mime['mime']=='image/png') {
            $src_img = imagecreatefrompng($path);
        }
        if($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg') {
            $src_img = imagecreatefromjpeg($path);
        }

        $old_x          =   imageSX($src_img);
        $old_y          =   imageSY($src_img);

        if($old_x > $old_y)
        {
            $thumb_w    =   $new_width;
            $thumb_h    =   $old_y*($new_height/$old_x);
        }

        if($old_x < $old_y)
        {
            $thumb_w    =   $old_x*($new_width/$old_y);
            $thumb_h    =   $new_height;
        }

        if($old_x == $old_y)
        {
            $thumb_w    =   $new_width;
            $thumb_h    =   $new_height;
        }

        $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);

        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);


        // New save location
        $new_thumb_loc = $moveToDir . $image_name;

        if($mime['mime']=='image/png') {
            $result = imagepng($dst_img,$new_thumb_loc,8);
        }
        if($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg') {
            $result = imagejpeg($dst_img,$new_thumb_loc,80);
        }

        imagedestroy($dst_img);
        imagedestroy($src_img);

        return $result;
    }

    public static function cekImg($obj)
    {
      if(empty($obj))
      {
        $obj = asset('/dist/img/user-icon.jpg');
      }else{
        $obj = Storage::url($obj);
      }

      return $obj;
    }

    public static function ConvertTglRange($obj)
    {
      $ex = explode("-", $obj);
      $date = self::tgl_indo_to_sql(trim($ex[0]))."/".self::tgl_indo_to_sql(trim($ex[1]));
      return $date;
    }

    public static function Terbilang($x)
    {
      $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      if ($x < 12)
        $re = " " . $abil[$x];
      elseif ($x < 20)
        $re = self::Terbilang($x - 10) . "belas";
      elseif ($x < 100)
        $re = self::Terbilang($x / 10) . " puluh" . self::Terbilang($x % 10);
      elseif ($x < 200)
        $re = " seratus" . self::Terbilang($x - 100);
      elseif ($x < 1000)
        $re = self::Terbilang($x / 100) . " ratus" . self::Terbilang($x % 100);
      elseif ($x < 2000)
        $re = " seribu" . self::Terbilang($x - 1000);
      elseif ($x < 1000000)
        $re = self::Terbilang($x / 1000) . " ribu" . self::Terbilang($x % 1000);
      elseif ($x < 1000000000)
        $re = self::Terbilang($x / 1000000) . " juta" . self::Terbilang($x % 1000000);

      return $re;
    }

    ############################# FUNGSI MENCARI TGL, BULAN, TAHUN FORMAT INDONESIA #############################
    public static function tampiltgl2($valtgl)
    {
    $temp=explode(substr($valtgl, 2, 1),$valtgl);
    $tgl=$temp[0];
    $bulan=$temp[1];
    $tahun=$temp[2];
    return $tgl." ".self::bulan_c($bulan)." ".$tahun;
    }

    #################### MENCARI BULAN DI DALAM FIELD ###################
    public static function bulan_c($nilai)
    {
    //
    if ($nilai=='01')
    {return "Jan";}
    elseif ($nilai=='02')
    {return "Feb";}
    elseif ($nilai=='03')
    {return "Mar";}
    elseif ($nilai=='04')
    {return "Apr";}
    elseif ($nilai=='05')
    {return "Mei";}
    elseif ($nilai=='06')
    {return "Jun";}
    elseif ($nilai=='07')
    {return "Jul";}
    elseif ($nilai=='08')
    {return "Agu";}
    elseif ($nilai=='09')
    {return "Sep";}
    elseif ($nilai=='10')
    {return "Okt";}
    elseif ($nilai=='11')
    {return "Nov";}
    elseif ($nilai=='12')
    {return "Des";}
    //end function
    }

    public static function bgStatus($obj)
    {
      $statusGreen = array('Aktif', '0');
      $statusRed = array('Tidak Aktif', '1');

      if(in_array($obj, $statusGreen))
      {
        $bg = 'bg-green';
      }else{
        $bg = 'bg-red';
      }

      return $bg;
    }
}
