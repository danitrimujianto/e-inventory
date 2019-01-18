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
          <input type="hidden" class="" name="karyawan_id" id="karyawan_id" value="{{ $data->karyawan_id }}" />
          <div class="row">
          @if(Auth::user()->usertype_id == 1)
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Employee</label>
                <div>
                  <input type="text" class="form-control needed" name="karyawan_name" id="lookup_karyawan" value="{{ $data->karyawan->name}}" autocomplete="off" readonly/>
                  <!-- <select class="form-control needed" name="karyawan_id" id="karyawan_id">
                    <option value="">-- Choose Employee --</option>
                    @foreach($dKaryawan AS $karyawan)
                      <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                    @endforeach
                  </select> -->
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Please Fill</span>
                </div>
              </div>
            </div>
            @endif
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control needed" name="project" id="project" value="{{ optional($data->project)->name }}" autocomplete="off" disabled/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Please Fill</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}" readonly />
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Purchase No</label>
                <div>
                  <input type="text" class="form-control" name="pr_no" id="pr_no" placeholder="" autocomplete="off" value="{{ $data->pr_no }}" readonly>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Due Date</label>
                <div>
                  <input type="text" class="form-control" name="due_date" id="due_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->due_date) }}" readonly />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Description</label>
                <div>
                  <textarea class="form-control" name="description" id="description" readonly>{{ $data->description }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <section id="tools">
            <h4 class="page-header">Items
              <!-- <button type="button" class="btn btn-primary pull-right btn-xs" id="btnListTools"><i class="fa fa-plus"></i> Add</button> -->
            </h4>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                  <th>Item</th>
                  <th>Merk</th>
                  <th>Type</th>
                  <th>Quantity</th>
                  <th class="text-right">Price</th>
                  <th class="text-right">Subtotal</th>
                </tr>
                <tbody id="listTools">
                @php
                $total = 0;
                $totalDetail = count($data->purchase_detail);
                @endphp
                @if($totalDetail > 0)
                @foreach($data->purchase_detail AS $detail)
                <tr>
                  <td>{{ $detail->item }}</td>
                  <td>{{ $detail->merk }}</td>
                  <td>{{ $detail->type }}</td>
                  <td>{{ HelpMe::cost2($detail->quantity) }}</td>
                  <td align="right">{{ HelpMe::cost2($detail->price) }}</td>
                  <td align="right">{{ HelpMe::cost2($detail->total) }}</td>
                </tr>
                @php
                $total = $total+$detail->total;
                @endphp
                @endforeach
                @else
                <tr>
                  <td colspan="6" class="text-center">Empty</td>
                </tr>
                @endif
                </tbody>
                <tfooter>
                <tr  id="toolsTotal" style=" @if($totalDetail == 0) display: none; @endif ">
                  <td colspan="5" align="right"><strong>Total:</strong></td>
                  <td align="right">{{ HelpMe::cost2($total) }}</td>
                </tr>
                </tfooter>
              </table>
            </div>
          </section>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="button" class="btn btn-default" id="backButton"><i class="fa fa-reply"></i>&nbsp;Back</button>

          @if(Auth::user()->usertype_id == 3 && $data->status == 0)
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
    var id = $("#id").val();
    var field = "Purchase No";
    var value = $("#pr_no").val();
    alertSweet("Are you sure to approve  ", id, field, value, modulPage, 'Accept');
  });

  $(".rejectButton").click(function(){
    var modulPage = $("#modulPage").val();
    var id = $("#id").val();
    var field = "Purchase No";
    var value = $("#pr_no").val();
    alertSweet("Are you sure to reject  ", id, field, value, modulPage, 'Reject');
  });
});
</script>
@endsection
