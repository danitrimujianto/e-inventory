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
            <label for="code">Name</label>
            <div>
              <input type="text" class="form-control needed" name="name" id="name" placeholder="" autocomplete="off" value="{{ $data->name }}" readonly>
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Address</label>
            <div>
              <textarea class="form-control" name="address" id="address" readonly>{{ $data->address }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Contact Person</label>
            <div>
              <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="" autocomplete="off" value="{{ $data->contact_person }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Phone</label>
            <div>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="" autocomplete="off" value="{{ $data->phone }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Date</label>
            <div>
              <input type="text" class="form-control datepicker" name="date" id="date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->date) }}" readonly>
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
