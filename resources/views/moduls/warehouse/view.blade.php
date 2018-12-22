<?php $search = ""; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Detail Data</h3>
      <div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="{{ $data->id }}">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="code">Warehouse Code</label>
            <div>
              <input type="text" class="form-control needed" name="code" id="code" placeholder="" autocomplete="off" value="{{ $data->code }}" readonly>
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Warehouse Name</label>
            <div>
              <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off" value="{{ $data->name }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Area</label>
            <div>
              <input type="text" class="form-control" name="area_id" id="area_id" value="{{ $data->area->name }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name">City</label>
            <div>
              <input type="text" class="form-control" name="city_id" id="city_id" value="{{ $data->city->name }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Status</label>
            <div>
              <select class="form-control" name="status" id="status" disabled>
                <option value="">-- Choose Status --</option>
                <option value="Aktif" @if($data->status == "Aktif") selected @endif>Aktif</option>
                <option value="Tidak Aktif" @if($data->status == "Tidak Aktif") selected @endif>Tidak Aktif</option>
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="button" class="btn btn-default" id="backButton"><i class="fa fa-reply"></i>&nbsp;Back</button>
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
  var viewer = new Viewer(document.getElementById('galley'));
});
</script>
@endsection
