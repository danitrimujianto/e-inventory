<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row">
				<div class="col-md-12" >
					<h4>Date</h4>
				</div>
				<div class="form-group">
        <form name="fReport" id="fReport" method="post" action="{{ '/'.$theme['modul'] }}">
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
            <button type="submit" id="" class="btn btn-default "><i class="fa fa-search"></i> Submit</button>
  					<button type="button" id="ReportPrintButton" class="btn btn-primary "><i class="fa fa-print"></i> Print</button>
  					<button type="button" id="ReportExcelButton" class="btn btn-danger"><i class="fa fa-file-excel-o"></i> Excel</button>
          </div>
  				</form>
				  <div class="col-md-2 col-xs-12 pull-right" style="  ">
            <button class="btn btn-default" id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button>
				  </div>
				</div>
				</div>
        <div class="row" id="searchForm" style=" display:none; ">
				<div class="col-md-12" >
					<h4>Filter</h4>
				</div>
        <form method="get" name="sReport" action="{{ '/'.$theme['modul'] }}">
          <input type="hidden" name="first_date" value="{{ $first_date }}" />
          <input type="hidden" name="second_date" value="{{ $second_date }}" />
				<div class="form-group">
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Status</label>-->
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Nomor</label>-->
				  <div class="col-md-5 col-xs-12">
  					<select name="sf" id="sf" class="form-control">
              <option value="pr_no" @if($sf == "pr_no") {{ 'selected' }} @endif>Purchase No</option>
              <option value="user_request" @if($sf == "user_request") {{ 'selected' }} @endif>User Request</option>
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
				</form>
				</div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-striped" style=" width: 100%; ">
          <thead>
          <tr>
            <th bgcolor="#CCCCCC">NO.</th>
            <th bgcolor="#CCCCCC">DATE</th>
            <th bgcolor="#CCCCCC">PURCHASE NO.</th>
            <th bgcolor="#CCCCCC">REQUESTOR</th>
            <th bgcolor="#CCCCCC">ITEM</th>
            <th bgcolor="#CCCCCC">MERK</th>
            <th bgcolor="#CCCCCC">TYPE</th>
            <th bgcolor="#CCCCCC">QTY</th>
            <th bgcolor="#CCCCCC" style=" text-align: right; ">PRICE</th>
            <th bgcolor="#CCCCCC" style=" text-align: right; ">TOTAL</th>
          </tr>
          </thead>
          <tbody>
          @php $no = 0; @endphp
          @foreach($data AS $d)
          @php $no++; @endphp
          <tr>
            <td>{{ $no.'.' }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->purchase_request->tanggal) }}</td>
            <td>{{ optional($d->purchase_request)->pr_no }}</td>
            <td>{{ optional($d->purchase_request->karyawan)->name }}</td>
            <td>{{ $d->item }}</td>
            <td>{{ $d->merk }}</td>
            <td>{{ $d->type }}</td>
            <td>{{ $d->quantity }}</td>
            <td style=" text-align: right; ">{{ HelpMe::cost2($d->price) }}</td>
            <td style=" text-align: right; ">{{ HelpMe::cost2($d->total) }}</td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
