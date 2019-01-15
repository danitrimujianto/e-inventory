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
        <input type="hidden" name="id" value="{{ $data->id }}">
        @csrf
        <div class="box-body">
          @if(Auth::user()->usertype_id == 1)
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Sender</label>
                <div>
                  <input type="text" class="form-control" name="sender_id" value="{{ optional($data->sender)->name }}" readonly>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Tanggal</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tgl) }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Outgoing No</label>
                <div>
                  <input type="text" class="form-control" name="outgoing_no" id="outgoing_no" placeholder="" autocomplete="off" value="{{ $data->outgoing_no }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Recipient</label>
                <div>
                  <input type="text" class="form-control" name="recipient_id" id="recipient_id" placeholder="" autocomplete="off" value="{{ optional($data->karyawan)->name }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control" name="project_id" id="project_id" placeholder="" autocomplete="off" value="{{ optional($data->project)->name }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Delivery By</label>
                <div>
                  <input type="text" class="form-control" name="delivery_id" id="delivery_id" placeholder="" autocomplete="off" value="{{ optional($data->delivery)->name }}" readonly>
                </div>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Receipt No</label>
                  <div>
                    <input type="text" class="form-control" name="receipt_no" id="receipt_no" placeholder="" autocomplete="off" value="{{ $data->receipt_no }}" readonly />
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">From Area</label>
                <div>
                  <input type="text" class="form-control" name="fromarea_id" id="fromarea_id" placeholder="" autocomplete="off" value="{{ optional($data->fromarea)->name }}" readonly />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">To Area</label>
                <div>
                  <input type="text" class="form-control" name="toarea_id" id="toarea_id" placeholder="" autocomplete="off" value="{{ optional($data->toarea)->name }}" readonly />
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
            <?php $tools = App\AllhoActivities::find($data->id)->AllhoDetail; ?>
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


          @if($d->status >= 0 && $d->status < 2)
          <button title="" type="button" class="btn btn-success acceptButton"><i class="fa fa-check"></i>&nbsp;Approve</button>
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
