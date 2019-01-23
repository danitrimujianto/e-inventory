<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
      <form name="fReport" id="fReport" method="post" action="{{ '/'.$theme['modul'] }}">
        <div class="row">
				<div class="col-md-12" >
					<h4>Date</h4>
				</div>
				<div class="form-group">
          @csrf
				  <div class="col-md-2 col-xs-12">
					<input type="text" name="first_date" id="first_date" class="form-control datepicker" placeholder="" value="{{ $first_date }}">
				  </div>
				  <div class="col-md-1 col-xs-12 text-center">
					to
				  </div>
				  <div class="col-md-2 col-xs-12">
					<input type="text" name="second_date" id="second_date" class="form-control datepicker" placeholder="" value="{{ $second_date }}">
				  </div>
          <div class="col-md-4">
            <button type="button" id="ReportSubmitButton" class="btn btn-default "><i class="fa fa-search"></i> Submit</button>
  					<button type="button" id="ReportPrintButton" class="btn btn-primary "><i class="fa fa-print"></i> Print</button>
  					<button type="button" id="ReportExcelButton" class="btn btn-danger"><i class="fa fa-file-excel-o"></i> Excel</button>
          </div>
				  <div class="col-md-2 col-xs-12 pull-right" style="  ">
            <button type="button" class="btn btn-default" id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button>
				  </div>
				</div>
				</div>
        <div class="row" id="searchForm" style=" display:none; ">
				<div class="col-md-12" >
					<h4>Filter</h4>
				</div>
				<div class="form-group">
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Status</label>-->
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Nomor</label>-->
				  <div class="col-md-5 col-xs-12">
  					<select name="sf" id="sf" class="form-control">
              <option value="item" @if($sf == "item") {{ 'selected' }} @endif>Item</option>
              <option value="code_tools" @if($sf == "code_tools") {{ 'selected' }} @endif>ID Tools</option>
              <option value="karyawan" @if($sf == "karyawan") {{ 'selected' }} @endif>Employee</option>
              <option value="project" @if($sf == "project") {{ 'selected' }} @endif>Project</option>
  					</select>
					</div>
				  <div class="col-md-5 col-xs-12">
					<input type="text" name="sq" id="sq" class="form-control" placeholder="" value="{{ $sq }}">
				  </div>
				  <div class="col-sm-2 col-xs-12" style="  ">
					<button class="btn btn-primary"><i class="fa fa-search"></i></button>
					<button type="button" id="resetFilterReport" class="btn btn-warning"><i class="fa fa-eraser"></i></button>
				  </div>
				</div>
				</div>
        </form>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table class="table table-striped" style=" width: 100%; ">
          <thead>
          <tr style="">
            <th>NO.</th>
            <th>ID TOOLS</th>
            <th>ITEM</th>
            <th>MERK</th>
            <th>TYPE</th>
            <th>SN</th>
            <th>IMEI</th>
            <th>AREA</th>
            <th>CITY</th>
            <th>PROJECT</th>
            <th>ID EMPLOYEE</th>
            <th>EMPLOYEE</th>
            <th>POSITION</th>
            <th>UPDATE DATE</th>
            <th>CONDITION</th>
            <!-- <th>PURCHASE</th> -->
            <!-- <th>PRICE</th> -->
          </tr>
          </thead>
          <tbody>
          @php $no = 0; @endphp
          @foreach($data AS $d)
          @php $no++; @endphp
          <tr>
            <td>{{ $no.'.' }}</td>
            <td>{{ optional($d->tools)->code }}</td>
            <td>{{ optional($d->tools)->item }}</td>
            <td>{{ optional($d->tools)->merk }}</td>
            <td>{{ optional($d->tools)->type }}</td>
            <td>{{ optional($d->tools)->serial_number }}</td>
            <td>{{ optional($d->tools)->imei }}</td>
            <td>{{ optional($d->handover->toarea)->name }}</td>
            <td>{{ optional($d->karyawan->assignmentarea)->name }}</td>
            <td>{{ optional($d->handover->project)->name }}</td>
            <td>{{ optional($d->karyawan)->id_karyawan }}</td>
            <td>{{ optional($d->karyawan)->name }}</td>
            <td>{{ optional($d->karyawan->position)->name }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->renew_date) }}</td>
            <td>{{ optional($d->condition)->name }}</td>
            <!-- <td>{{ HelpMe::tgl_sql_to_indo($d->tools->date) }}</td>
            <td>{{ HelpMe::cost($d->tools->price) }}</td> -->
          </tr>
          @endforeach
          </tbody>
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
                <input type="hidden" name="first_date" value="{{ $first_date }}">
                <input type="hidden" name="second_date" value="{{ $second_date }}">
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
          @if(!empty($sq)) {{ $data->appends(['first_date' => $first_date, 'second_date' => $second_date, 'bts'=>$bts, 'sf' => $sf,'sq' => $sq])->links() }} @else {{ $data->render() }} @endif
        </div>
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
