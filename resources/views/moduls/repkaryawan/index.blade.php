<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <form name="fReport" method="get" action="{{ '/'.$theme['modul'] }}">
      <div class="box-header">
        <button type="button" class="btn btn-default" id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button>
        <div class="box-tools">
            <button type="button" class="btn btn-primary " id="ReportPrintButton"><i class="fa fa-print"></i> Print</button>
            <button type="button" class="btn btn-danger " id="ReportExcelButton"><i class="fa fa-file-excel-o"></i> Excel</button>
        </div>
        <div class="row" id="searchForm" style=" display:none; ">
				<div class="col-md-12" >
					<h4>Filter</h4>
				</div>
				<div class="form-group">
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Status</label>-->
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Nomor</label>-->
				  <div class="col-md-5 col-xs-12">
  					<select name="sf" class="form-control">
              <option value="id_karyawan" @if($sf == "id_karyawan") {{ 'selected' }} @endif>ID Employee</option>
              <option value="name" @if($sf == "name") {{ 'selected' }} @endif>Name</option>
              <option value="Department" @if($sf == "Department") {{ 'selected' }} @endif>Department</option>
              <option value="Project" @if($sf == "Project") {{ 'selected' }} @endif>Project</option>
              <option value="Assignment Area" @if($sf == "Assignment Area") {{ 'selected' }} @endif>Assignment Area</option>
  					</select>
					</div>
				  <div class="col-md-5 col-xs-12">
					<input type="text" name="sq" id="sq" class="form-control" placeholder="" value="{{ $sq }}">
				  </div>
				  <div class="col-sm-2 col-xs-12" style="  ">
					<button type="button" id="ReportSubmitButton" class="btn btn-primary"><i class="fa fa-search"></i></button>
					<button type="button" id="resetFilter" class="btn btn-warning"><i class="fa fa-eraser"></i></button>
				  </div>
				</div>
				</div>
      </div>
      </form>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>ID Employee</th>
            <th>Name</th>
            <th>Departemen</th>
            <th>Position</th>
            <th>Project</th>
            <!-- <th>Home Area</th> -->
            <th>Assignment Area</th>
            <th>Phone</th>
            <!-- <th>Email</th> -->
            <th>Status</th>
          </tr>
          @foreach($data AS $d)
          <tr data-id="{{ $d->id }}" data-field="{{ 'Tool' }}" data-value="{{ $d->item }}">
            <td>{{ $d->id_karyawan }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ optional($d->departemen)->name }}</td>
            <td>{{ optional($d->position)->position }}</td>
            <td>{{ optional($d->project)->name }}</td>
            <!-- <td>{{ optional($d->homebasearea)->name }}</td> -->
            <td>{{ optional($d->assignmentarea)->name }}</td>
            <td>{{ $d->phone_number }}</td>
            <!-- <td>{{ $d->email }}</td> -->
            <td><small class="label {{ HelpMe::bgStatus($d->status) }}">{{ $d->status }}</small></td>
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
          @if(!empty($sq)) {{ $data->appends(['bts' => $bts, 'sf' => $sf,'sq' => $sq])->links() }} @else {{ $data->render() }} @endif
        </div>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
