<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <!-- <button class="btn btn-success" id="addButton"><i class="fa fa-plus"></i> Add New</button> -->

          <button class="btn btn-default pull-right" id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button>

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
              <option value="outgoing_no" @if($sf == "outgoing_no") {{ 'selected' }} @endif>Outgoing No</option>
              <option value="from" @if($sf == "from") {{ 'selected' }} @endif>From</option>
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
            <th>Status</th>
            <th>Date</th>
            <th>Outgoing No</th>
            <th>From</th>
            @if(Auth::user()->usertype_id != 4)<th>To</th>@endif
            <th>Delivery</th>
            <th>Project</th>
            <th>From City</th>
            <th>To City</th>
            <th style=" width: 16%; ">Action</th>
          </tr>
          @foreach($data AS $d)
          <tr class="viewRowButton" data-id="{{ $d->id }}" data-field="{{ 'Outgoing No' }}" data-value="{{ $d->outgoing_no }}">
            <td><?php echo $d->status.'-'.HelpLocal::checkStatusAllHo($d->status, $d->type) ?></td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->tgl) }}</td>
            <td>{{ $d->outgoing_no }}</td>
            <td>@if($d->type == 'office') {{ ucwords($d->type) }} @else {{ optional($d->sender)->name }} @endif</td>
            @if(Auth::user()->usertype_id != 4)
            <td>{{ optional($d->karyawan)->name }}</td>
            @endif
            <td>{{ optional($d->delivery)->name }}</td>
            <td>{{ optional($d->project)->name }}</td>
            <td>{{ optional($d->fromcity)->name }}</td>
            <td>{{ optional($d->tocity)->name }}</td>
            <td>
              <!-- <button title="" type="button" class="btn btn-xs tooltips btn-warning viewButton"><i class="fa fa-eye"></i>&nbsp;View</button> -->
              @if($d->status >= 0 && $d->status < 2)
              <button title="" type="button" class="btn btn-xs tooltips btn-success acceptButton"><i class="fa fa-check"></i>&nbsp;Accept</button>
              <button title="" type="button" class="btn btn-xs tooltips btn-danger rejectButton"><i class="fa fa-remove"></i>&nbsp;Reject</button>
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
  $(".acceptButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to accept  ", id, field, value, modulPage, 'Accept');
  });

  $(".rejectButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $(this).parent('td').parent('tr').attr('data-id');
    var field = $(this).parent('td').parent('tr').attr('data-field');
    var value = $(this).parent('td').parent('tr').attr('data-value');
    alertSweet("Are you sure to reject  ", id, field, value, modulPage, 'Reject');
  });
});
</script>
@endsection
