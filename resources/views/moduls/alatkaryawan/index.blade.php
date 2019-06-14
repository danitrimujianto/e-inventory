<?php
$price = ((Auth::user()->usertype_id == 4 ||
            Auth::user()->usertype_id == 5) ? false : true);
?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row">
				<div class="col-md-12" >
        @if(!$price)
        <!-- <div class="col-md-2 col-xs-2">
          <button class="btn btn-success" id="renewButton"><i class="fa fa-refresh"></i> Update Date </button>
        </div> -->
        @endif
        <div class="box-tools pull-right">
          <button class="btn btn-danger " id="excelButton"><i class="fa fa-file-excel-o"></i> Excel</button>
          <button class="btn btn-primary " id="printButton"><i class="fa fa-print"></i> Print</button>
          <!-- <button class="btn btn-default " id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button> -->
        </div>
        <div class="col-md-4 col-xs-4">
        <form method="get" action="{{ '/'.$theme['modul'] }}">
          <select name="lastUpdate" id="lastUpdate" class="form-control" onchange="submit()" >
            <option value="">-- Tampil Semua --</option>
            <option value="sudah" @if($lastUpdate == 'sudah') selected @endif>Sudah Update</option>
            <option value="belum" @if($lastUpdate == 'belum') selected @endif>Belum Update</option>
          </select>
        </form>
        </div>
      </div>
    </div>
        <div class="row" id="searchForm" >
				<div class="col-md-12" >
					<h4>Search</h4>
				</div>
        <form method="get" action="{{ '/'.$theme['modul'] }}">
				<div class="form-group">
				  <div class="col-md-5 col-xs-12">
  					<select name="sf" id="sf" class="form-control">
              <option value="item" @if($sf == "item") {{ 'selected' }} @endif>Item</option>
              <option value="code_tools" @if($sf == "code_tools") {{ 'selected' }} @endif>ID Tools</option>
              <option value="karyawan" @if($sf == "karyawan") {{ 'selected' }} @endif>Karyawan</option>
              <option value="project" @if($sf == "project") {{ 'selected' }} @endif>Project</option>
              <option value="serial_number" @if($sf == "serial_number") {{ 'selected' }} @endif>Serial Number</option>
              <option value="imei" @if($sf == "imei") {{ 'selected' }} @endif>Imei</option>
  					</select>
					</div>
				  <div class="col-md-5 col-xs-12">
					<input type="text" name="sq" id="sq" class="form-control" placeholder="" value="{{ $sq }}">
				  </div>
				  <div class="col-sm-2 col-xs-12" style="  ">
					<button class="btn btn-primary"><i class="fa fa-search"></i></button>
					<button type="button" id="resetFilter" class="btn btn-warning"><i class="fa fa-eraser"></i></button>
				  </div>
				</div>
				</form>
				</div>
      </div>
      <!-- /.box-header -->
      <form name="fList" id="fList" method="post" action="{{ '/'.$theme['modul'] }}">
        <input type="hidden" name="on" value="y"/>
        @csrf
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>Check</th>
            <th>ID Tools</th>
            <th>Code</th>
            <th>Item</th>
            <th>Serial Number</th>
            <th>Imei</th>
            <th>Condition</th>
            <th>Project</th>
            <th>Employee</th>
            <th>Homebase</th>
            <th>Assignment</th>
            <th>Prev Update</th>
            <th>Last Update</th>
            @if($price)
              <th>Price</th>
            @endif
          </tr>
          @foreach($data AS $d)
          <tr class="" data-id="{{ $d->id }}" data-field="{{ 'Outgoing No' }}" data-value="{{ $d->outgoing_no }}">
            <td><input type="checkbox" class="id_tool rowFocus" name="idTools[]" value="{{ optional($d->tools)->id }}" /></td>
            <td>{{ optional($d->tools)->id }}</td>
            <td>{{ optional($d->tools)->code }}</td>
            <td>{{ optional($d->tools)->item }}</td>
            <td>{{ optional($d->tools)->serial_number }}</td>
            <td>{{ optional($d->tools)->imei }}</td>
            <td>{{ optional($d->condition)->name }}</td>
            <td>{{ optional($d->karyawan->project)->name }}</td>
            <td>{{ optional($d->karyawan)->name }}</td>
            <td>{{ optional($d->karyawan->homebasearea)->name }}</td>
            <td>{{ optional($d->karyawan->assignmentarea)->name }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->prev_update) }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->renew_date) }}</td>
            @if($price)
              <td>{{ HelpMe::cost(optional($d->tools)->price) }}</td>
            @endif
          </tr>
          @endforeach
        </table>
      </div>
      </form>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
				<div class="col-md-6">
					<table class="">
						<tr>
              <td>
								<div class="btn-group dropup">
									  <button type="button" class="btn btn-default  ">Bulk Action</button>
									  <button aria-expanded="false" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu bulk-action" role="menu">
										<li><a href="javascript:void(0)" id="handoverBulk"><i class="fa fa-hand-o-left"></i> Handover</a></li>
										<li><a href="javascript:void(0)" id="returBulk"><i class="fa fa-refresh"></i> Retur</a></li>
										<li class="divider">&nbsp;</li>
										<li><a href="javascript:void(0)" id="updateBulk"><i class="fa fa-tasks"></i> Update Tool</a></li>
									  </ul>
								</div>
							</td>
							<td>&nbsp;&nbsp;Menampilkan&nbsp;&nbsp;</td>
							<td>
								<form name="fBatas" method="GET" action="{{ '/'.$theme['modul'] }}">
                  @if(!empty($sq))
                    <input type="hidden" name="sf" value="{{ $sf }}">
                    <input type="hidden" name="sq" value="{{ $sq }}">
                  @endif
									<select name="bts" id="batas" class="form-control input-sm" onchange=" submit(); ">
										<option value="10" @if($bts == '10') {{ 'selected' }} @endif>10</option>
										<option value="20" @if($bts == '20') {{ 'selected' }} @endif>20</option>
										<option value="50" @if($bts == '50') {{ 'selected' }} @endif>50</option>
										<option value="100"@if($bts == '100') {{ 'selected' }} @endif>100</option>
									</select>
								</form>
							</td>
							<td>&nbsp; dari total {{ $data->total() }} data</td>
						</tr>
					</table>
				</div>
        <div class="col-md-6" style="padding:0;">
          @if(!empty($sq)) {{ $data->appends(['bts'=>$bts, 'sf' => $sf,'sq' => $sq])->links() }} @else {{ $data->render() }} @endif
        </div>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
@section('scriptAdd')
<script>
$(document).ready(function(){

  $('.rowFocus').click(function(){
    var topRow = $(this).parent('td').parent('tr');
    if($(this).prop('checked')){
      topRow.css('background','#CCCCCC');
    }else{
      topRow.css('background','#FFFFFF');
    }
  });

  $("#renewButton").click(function(){
      var modulPage = $("#modulPage").val();
      document.location.href='/'+modulPage+'/renew';
  });
  $("#handoverBulk").click(function(){
    var jmlChecked = $(".id_tool:checked").length;
    if(jmlChecked > 0){
      var modulPage = $("#modulPage").val();
      document.fList.action='/handover/add/bulk';
      document.fList.submit();
    }else{
      alert('Centang salah satu baris');
    }
  });
  $("#returBulk").click(function(){
    var jmlChecked = $(".id_tool:checked").length;
    if(jmlChecked > 0){
      var modulPage = $("#modulPage").val();
      document.fList.action='/horetur/add/bulk';
      document.fList.submit();
    }else{
      alert('Centang salah satu baris');
    }
  });
  $("#updateBulk").click(function(){
    var jmlChecked = $(".id_tool:checked").length;
    if(jmlChecked > 0){
      var modulPage = $("#modulPage").val();
      document.fList.action='/'+modulPage+'/renew/bulk';
      document.fList.submit();
    }else{
      alert('Centang salah satu baris');
    }
  });
});
</script>
@endsection
