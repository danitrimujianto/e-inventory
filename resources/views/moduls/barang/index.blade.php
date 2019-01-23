<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <button class="btn btn-success" id="addButton"><i class="fa fa-plus"></i> Add New</button>
        <div class="box-tools">
          <button class="btn btn-default" id="filterButton"><i class="fa fa-filter"></i> Filter @if(!empty($sq)) <small class="label bg-yellow "> ON</small> @endif</button>
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
              <option value="code" @if($sf == "code") {{ 'selected' }} @endif>Code</option>
              <option value="name" @if($sf == "name") {{ 'selected' }} @endif>Name</option>
              <option value="type" @if($sf == "type") {{ 'selected' }} @endif>Type</option>
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
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th style=" width: 16%; ">Action</th>
          </tr>
          @foreach($data AS $d)
          <tr data-id="{{ $d->id }}" data-field="{{ 'Division' }}" data-value="{{ $d->name }}">
            <td>{{ $d->code }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->type }}</td>
            <td>
              <button title="" type="button" class="btn btn-xs tooltips btn-warning viewButton"><i class="fa fa-eye"></i>&nbsp;View</button>
              <button title="" type="button" class="btn btn-xs tooltips btn-info editButton"><i class="fa fa-pencil"></i>&nbsp;Edit</button>
              <button title="" type="button" class="btn btn-xs tooltips btn-danger deleteButton"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
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
