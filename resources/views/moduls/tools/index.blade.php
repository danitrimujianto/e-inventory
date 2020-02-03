<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <button class="btn btn-success" id="addButton"><i class="fa fa-plus"></i> Add New</button>
        <div class="box-tools">
            <button class="btn btn-danger " id="excelButton"><i class="fa fa-file-excel-o"></i> Excel</button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>ID Tools</th>
            <th>Date</th>
            <th>Item</th>
            <th>Merk</th>
            <th>Type</th>
            <th>SN</th>
            <th>Imei</th>
            <th>Price</th>
            <th>Created By</th>
            <th style=" width: 16%; ">Action</th>
          </tr>
          <form method="post" action="{{ '/'.$theme['modul'].'/search' }}">
          @csrf
          <tr>
            <td><input type="text" name="sf[code]" class="form-control" placeholder="" value="@if(is_array($sf)){{trim($sf['code'])}}@endif" style="text-align:left;"></td>
            <td><input type="text" name="sf[tgl]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['tgl']) }} @endif" style="text-align:left;"></td>
            <td><input type="text" name="sf[item]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['item']) }} @endif" style="text-align:left;"></td>
            <td><input type="text" name="sf[merk]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['merk']) }} @endif" style="text-align:left;"></td>
            <td><input type="text" name="sf[type]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['type']) }} @endif" style="text-align:left;"></td>
            <td><input type="text" name="sf[serial_number]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['serial_number']) }} @endif" style="text-align:left;"></td>
            <td><input type="text" name="sf[imei]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['imei']) }} @endif" style="text-align:left;"></td>
            <td>&nbsp;</td>
            <td><input type="text" name="sf[created_by]" id="" class="form-control" placeholder="" value="@if(is_array($sf)) {{trim($sf['created_by']) }} @endif"></td>
            <td>
              <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
              <button type="reset" id="resetFilter" class="btn btn-warning btn-sm"><i class="fa fa-eraser"></i></button>
            </td>
          </tr>
				  </form>
          @foreach($data AS $d)
          <tr data-id="{{ $d->id }}" data-field="{{ 'Tool' }}" data-value="{{ $d->item }}">
            <td>{{ $d->code }}</td>
            <td>{{ HelpMe::tgl_sql_to_indo($d->tgl) }}</td>
            <td>{{ $d->item }}</td>
            <td>{{ $d->merk }}</td>
            <td>{{ $d->type }}</td>
            <td>{{ $d->serial_number }}</td>
            <td>{{ $d->imei }}</td>
            <td>{{ HelpMe::cost($d->price) }}</td>
            <td>{{ $d->created_by }}</td>
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
