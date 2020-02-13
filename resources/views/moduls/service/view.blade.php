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
        <input type="hidden" name="id" id="id_data" value="{{ $data->id }}">
        @csrf
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control " name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Start Date</label>
                <div>
                  <input type="text" class="form-control" name="start_date" id="start_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->start_date) }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Finish Date</label>
                <div>
                  <input type="text" class="form-control" name="finish_date" id="finish_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->finish_date) }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <div>
              <textarea class="form-control" name="remarks" id="remarks" readonly>{{ $data->remarks }}</textarea>
            </div>
          </div>
          <section id="tools">
            <h4 class="page-header">Tools
            </h4>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                  <th>Item</th>
                  <th>Problem</th>
                  <th>Condition</th>
                  <th>Merk</th>
                  <th>Serial Number</th>
                  <th>Imei</th>
                  <th>Estimate Price</th>
                </tr>
                <tbody id="listTools">
                <?php $detail = false; $total = 0; $item = ""; ?>
                @if($data->ServiceDetail->count() > 0)
                <?php $detail = true; ?>
                @foreach($data->ServiceDetail AS $detil)
                <tr>
                  <td><?php echo $detil->tools->code." - ".$detil->tools->item; ?></td>
                  <td><?php echo $detil->problem; ?></td>
                  <td><?php echo $detil->condition->name; ?></td>
                  <td><?php echo $detil->tools->merk; ?></td>
                  <td><?php echo $detil->tools->serial_number; ?></td>
                  <td><?php echo $detil->tools->imei; ?></td>
                  <td class="text-right"><?php echo HelpMe::cost2($detil->price); ?></td>
                </tr>
                <?php $total = $total+$detil->price; $item .= $detil->tools->item.','; ?>
                @endforeach
                @else
                  @if(!empty($data->tools_id))
                  <?php $detail = true; ?>
                  <tr>
                    <td><?php echo $data->tools->code." - ".$data->tools->item; ?></td>
                    <td><?php echo $data->problem; ?></td>
                    <td><?php echo $data->condition->name; ?></td>
                    <td><?php echo $data->tools->merk; ?></td>
                    <td><?php echo $data->tools->serial_number; ?></td>
                    <td><?php echo $data->tools->imei; ?></td>
                    <td class="text-right"><?php echo HelpMe::cost2($data->price); ?></td>
                  </tr>
                  <?php $total = $total+$data->price; $item = $data->tools->item; ?>
                  @else
                  <tr>
                    <td colspan="8" class="text-center">Empty</td>
                  </tr>
                  @endif
                @endif
                </tbody>
                <tbody class="disTotal" style="<?php if(!$detail) echo 'display:none;'; ?>">
                  <tr>
                    <td colspan="6" class="text-right">Total:</td>
                    <td class="subtotal text-right"><?php echo HelpMe::cost2($total); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="button" class="btn btn-default" id="backButton"><i class="fa fa-reply"></i>&nbsp;Back</button>
          @if(empty($data->status) || $data->status == "0")
            <button title="" type="button" class="btn btn-danger rejectButton pull-right"><i class="fa fa-remove"></i>&nbsp;Reject</button>
            <button style="margin-right: 30px;" title="" type="button" class="btn btn-success acceptButton pull-right"><i class="fa fa-check"></i>&nbsp;Approve</button>
          @elseif($data->status == "1")
            <button title="" type="button" class="btn btn-primary finishButton pull-right"><i class="fa fa-minus-circle"></i>&nbsp;Finish</button>
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
    var id = $("#id_data").val();
    var field = "Service";
    var value = '<?php echo $item; ?>';
    alertSweet("Are you sure to approve  ", id, field, value, modulPage, 'Accept');
  });

  $(".rejectButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $("#id_data").val();
    var field = "Service";
    var value = $("#item").val();
    alertSweet("Are you sure to reject  ", id, field, value, modulPage, 'Reject');
  });

  $(".finishButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $("#id_data").val();
    var field = "Service";
    var value = $("#item").val();
    alertSweet("Are you sure to finish  ", id, field, value, modulPage, 'Finish');
  });
});
</script>
@endsection
