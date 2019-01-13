<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row" id="searchForm">
				<div class="col-md-12" >
					<h4>Date</h4>
				</div>
        <form name="fReport" id="fReport" method="post" action="{{ '/'.$theme['modul'] }}">
          @csrf
				<div class="form-group">
				  <div class="col-md-2 col-xs-12">
					<input type="text" name="first_date" id="first_date" class="form-control datepicker" placeholder="" value="">
				  </div>
				  <div class="col-md-1 col-xs-12 text-center">
					to
				  </div>
				  <div class="col-md-2 col-xs-12">
					<input type="text" name="second_date" id="second_date" class="form-control datepicker" placeholder="" value="">
				  </div>
				  <div class="col-sm-7 col-xs-12" style="  ">
					<button type="button" id="ReportPrintButton" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
					<button type="button" id="ReportExcelButton" class="btn btn-danger pull-right"><i class="fa fa-file-excel-o"></i> Excel</button>
				  </div>
				</div>
				</form>
				</div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        &nbsp;
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
