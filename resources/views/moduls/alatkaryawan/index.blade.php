<?php
$price = (Auth::user()->usertype_id == 4 ? false : true);
?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row">
				<div class="col-md-12" >
        @if(Auth::user()->usertype_id == 4)
        <button class="btn btn-success" id="renewButton"><i class="fa fa-refresh"></i> Update Date </button>
        @endif
        <div class="box-tools pull-right">
          <button class="btn btn-danger " id="excelButton"><i class="fa fa-file-excel-o"></i> Excel</button>
          <button class="btn btn-primary " id="printButton"><i class="fa fa-print"></i> Print</button>
          <!-- <button class="btn btn-default " id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button> -->
        </div>
      </div>
    </div>
        <div class="row" id="searchForm" >
				<div class="col-md-12" >
					<h4>Search</h4>
				</div>
        <form method="get" action="{{ '/'.$theme['modul'] }}">
				<div class="form-group">
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Status</label>-->
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Nomor</label>-->
				  <div class="col-md-5 col-xs-12">
  					<select name="sf" class="form-control">
              <option value="item" @if($sf == "item") {{ 'selected' }} @endif>Item</option>
              <option value="code_tools" @if($sf == "code_tools") {{ 'selected' }} @endif>ID Tools</option>
              <option value="karyawan" @if($sf == "karyawan") {{ 'selected' }} @endif>Karyawan</option>
              <option value="project" @if($sf == "project") {{ 'selected' }} @endif>Project</option>
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
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>ID Tools</th>
            <th>Item</th>
            <th>Serial Number</th>
            <th>Imei</th>
            <th>Condition</th>
            <th>Project</th>
            <th>Karyawan</th>
            <th>Area</th>
            <th>City</th>
            <th>Update Date</th>
            @if($price)
              <th>Price</th>
            @endif
          </tr>
          @foreach($data AS $d)
          <tr class="" data-id="{{ $d->id }}" data-field="{{ 'Outgoing No' }}" data-value="{{ $d->outgoing_no }}">
            <td>{{ optional($d->tools)->code }}</td>
            <td>{{ optional($d->tools)->item }}</td>
            <td>{{ optional($d->tools)->serial_number }}</td>
            <td>{{ optional($d->tools)->imei }}</td>
            <td>{{ optional($d->condition)->name }}</td>
            <td>{{ optional($d->handover->project)->name }}</td>
            <td>{{ optional($d->karyawan)->name }}</td>
            <td>{{ optional($d->handover->toarea)->name }}</td>
            <td>{{ optional($d->karyawan->assignmentarea)->name }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->renew_date) }}</td>
            @if($price)
              <td>{{ HelpMe::cost(optional($d->tools)->price) }}</td>
            @endif
          </tr>
          @endforeach
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
				<div class="col-md-6">
					<table class="">
						<tr>
							<td>Menampilkan&nbsp;&nbsp;</td>
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
          @if(!empty($sq)) {{ $data->appends(['sf' => $sf,'sq' => $sq])->links() }} @else {{ $data->render() }} @endif
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
  $("#renewButton").click(function(){
    var modulPage = $("#modulPage").val();
    document.location.href='/'+modulPage+'/renew';
  });
});
</script>
@endsection
