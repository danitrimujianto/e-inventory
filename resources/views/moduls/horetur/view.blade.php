<?php $search = ""; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Detail Data</h3>
      </div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
        @csrf
        <div class="box-body">
          @if(Auth::user()->usertype_id == 1)
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Sender</label>
                <div>
                  <input type="text" class="form-control needed" name="karyawan_name" id="lookup_karyawan" value="" autocomplete="off" readonly/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tgl) }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Code</label>
                <div>
                  <input type="text" class="form-control" name="kode" id="kode" placeholder="" autocomplete="off" value="{{ $data->kode }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control needed" name="project_name" id="lookup_project" value="{{ optional($data->project)->name }}" autocomplete="off" readonly/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Delivery By</label>
                <div>
                  <input type="text" class="form-control needed" name="delivery_name" id="lookup_delivery" value="{{ optional($data->delivery)->name }}" autocomplete="off" readonly/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name">Remarks</label>
                  <div>
                    <textarea class="form-control" name="remarks" id="remarks" readonly>{{ $data->remarks }}</textarea>
                  </div>
                </div>
              </div>
          </div>

          <div class="row" style=" display:none; ">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Condition</label>
                <div id="conditionList">
                  <select class="form-control goods_condition_id" name="goods_condition_id[]" disabled="true">
                    <option value="">-- Choose Condition --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <section id="tools">
          <?php $tools = App\ReturTools::find($data->id)->ReturDetail; ?>
            <h4 class="page-header">Tools</h4>
            <table class="table table-bordered">
                <tr>
                  <th>Item</th>
                  <th>Condition</th>
                  <th>Merk</th>
                  <th>Type</th>
                  <th>Serial Number</th>
                  <th>Imei</th>
                </tr>
                <tbody id="listTools">
                @foreach($tools AS $detail)
                <tr>
                    <td>{{ optional($detail->tools)->code.' - '.optional($detail->tools)->item }}</td>
                    <td>{{ optional($detail->condition)->name }}</td>
                    <td>{{ optional($detail->tools)->merk }}</td>
                    <td>{{ optional($detail->tools)->type }}</td>
                    <td>{{ optional($detail->tools)->serial_number }}</td>
                    <td>{{ optional($detail->tools)->imei }}</td>
                </tr>
                @endforeach
                @if(!$tools)
                <tr>
                  <td colspan="6" class="text-center">Empty</td>
                </tr>
                @endif
                </tbody>
              </table>
          </section>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="button" class="btn btn-default" id="backButton"><i class="fa fa-reply"></i>&nbsp;Back</button>

          @if(Auth::user()->usertype_id == 2 && $data->status == 0)
          <button title="" type="button" class="btn btn-success acceptButton"><i class="fa fa-check"></i>&nbsp;Accept</button>
          <button title="" type="button" class="btn btn-danger pull-right rejectButton"><i class="fa fa-remove"></i>&nbsp;Reject</button>
          @endif
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>
<div >
</div>
<!-- /.row (main row) -->
@section('scriptAdd')
<script>
$(document).ready(function(){
  $(".acceptButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $("#id").val();
    var field = "Code";
    var value = $("#kode").val();
    alertSweet("Are you sure to accept  ", id, field, value, modulPage, 'Accept');
  });

  $(".rejectButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $("#id").val();
    var field = "Code";
    var value = $("#kode").val();
    alertSweet("Are you sure to reject  ", id, field, value, modulPage, 'Reject');
  });
});
</script>
@endsection
