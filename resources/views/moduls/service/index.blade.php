<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="row">
				<div class="col-md-12" >
        @if(Auth::user()->usertype_id != 3) <button class="btn btn-success" id="addButton"><i class="fa fa-plus"></i> Add New</button> @endif
        <div class="box-tools  pull-right">
          <button class="btn btn-default" id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button>
        </div>
      </div>
    </div>
        <div class="row" id="searchForm" style=" display:none; ">
				<div class="col-md-12" >
					<h4>Filter</h4>
				</div>
        <form method="get" action="{{ '/'.$theme['modul'] }}">
				<div class="form-group">
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Status</label>-->
				  <!--<label for="list_price" class="col-sm-2 col-xs-12 control-label">Nomor</label>-->
				  <div class="col-md-5 col-xs-12">
  					<select name="sf" class="form-control">
              <option value="item" @if($sf == "item") {{ 'selected' }} @endif>Item</option>
              <option value="code" @if($sf == "code") {{ 'selected' }} @endif>ID Tools</option>
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
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th style=" width: 10%; ">Status</th>
            <th style=" width: 10%; ">Start Date</th>
            <th style=" width: 10%; ">Finish Date</th>
            <th>Remarks</th>
            <th style=" width: 20%; ">Action</th>
          </tr>
          @foreach($data AS $d)
          <tr class="viewRowButton" data-id="{{ $d->id }}" data-field="{{ 'Service' }}" data-value="{{ optional($d->tools)->item }}">
            <td><?php echo $d->status() ?></td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->start_date) }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->finish_date) }}</td>
            <td>{{ $d->remarks }}</td>
            <td>
            @if(Auth::user()->usertype_id == 3)
              @if(empty($d->status) || $d->status == 0)
              <button title="" type="button" class="btn btn-xs tooltips btn-success acceptButton"><i class="fa fa-check"></i>&nbsp;Approve</button><br/><br/>
              <button title="" type="button" class="btn btn-xs tooltips btn-danger rejectButton"><i class="fa fa-remove"></i>&nbsp;Reject</button>
              @endif
            @else
                <button title="" type="button" class="btn btn-xs tooltips btn-info editButton"><i class="fa fa-pencil"></i>&nbsp;Edit</button>
                <!-- <button title="" type="button" class="btn btn-xs tooltips btn-danger cancelButton"><i class="fa fa-remove"></i>&nbsp;Cancel</button> -->
                <button title="" type="button" class="btn btn-xs tooltips btn-danger deleteButton"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                <button title="" type="button" class="btn btn-xs tooltips btn-primary finishButton"><i class="fa fa-minus-circle"></i>&nbsp;Finish</button>
              @endif
            </td>
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
  $(".cancelButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to cancel  ", id, field, value, modulPage, 'Cancel');
  });

  $(".acceptButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to approve  ", id, field, value, modulPage, 'Accept');
  });

  $(".closeButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to close  ", id, field, value, modulPage, 'Close');
  });

  $(".rejectButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to reject  ", id, field, value, modulPage, 'Reject');
  });

  $(".finishButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to finish  ", id, field, value, modulPage, 'Finish');
  });
});
</script>
@endsection
