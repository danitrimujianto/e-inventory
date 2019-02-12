<?php
 ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Data</h3>
      </div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <input type="hidden" name="barang_id" value="{{ $data->barang_id }}">
        <input type="hidden" name="division_id" value="{{ $data->division_id }}">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="code">Date</label>
            <div>
              <input type="text" class="form-control needed datepicker" name="tgl" id="tgl" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tgl) }}">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="code">Division</label>
                <div>
                  <select class="form-control needed" name="division_id2" id="division_id2" disabled>
                    <option value="">-- Choose Division --</option>
                    @foreach($dDivision AS $division)
                      <option value="{{ $division->id }}" @if($data->division_id == $division->id) selected @endif>{{ $division->name }}</option>
                    @endforeach
                  </select>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="code">Barang</label>
                <div>
                  <select class="form-control needed" name="barang_id2" id="barang_id2" disabled>
                    <option value="">-- Choose Barang --</option>
                    @foreach($dBarang AS $barang)
                      <option value="{{ $barang->id }}" @if($data->barang_id == $barang->id) selected @endif>{{ $barang->name }}</option>
                    @endforeach
                  </select>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Item</label>
            <div>
              <input type="text" class="form-control" name="item" id="item" placeholder="" autocomplete="off" value="{{ $data->item }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Merk</label>
            <div>
              <input type="text" class="form-control" name="merk" id="merk" placeholder="" autocomplete="off" value="{{ $data->merk }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Type</label>
            <div>
              <input type="text" class="form-control" name="type" id="type" placeholder="" autocomplete="off" value="{{ $data->type }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Serial Number</label>
            <div>
              <input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="" autocomplete="off" value="{{ $data->serial_number }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Imei</label>
            <div>
              <input type="text" class="form-control" name="imei" id="imei" placeholder="" autocomplete="off" value="{{ $data->imei }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Price</label>
            <div>
              <input type="text" class="form-control nominal" name="price" id="price" placeholder="" autocomplete="off" value="{{ HelpMe::cost($data->price) }}">
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <div>
              <textarea class="form-control" name="remarks" id="remarks">{{ $data->remarks }}</textarea>
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="button" class="btn btn-default" id="backButton"><i class="fa fa-reply"></i>&nbsp;Back</button>
          <button type="button" class="btn btn-success" id="saveButton"><i class="fa fa-save"></i>&nbsp;Save</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
@section('scriptAdd')
<script>
$(document).ready(function(){
  $('#barang_id').change(function(){
    var id = $(this).val();
    $.ajax({
      url: "/barang/select",
      data: 'id=' + id,
      dataType: "json",
      type: "GET",
      success: function (data) {
        // console.log(data);
        $('#item').val(data.name);
        $('#type').val(data.type);
      }
    });
  });
});
</script>
@endsection
