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
            <label for="name">Project Name</label>
            <div>
              <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off" value="{{ $data->name }}" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Vendor</label>
            <div>
              <select class="form-control" name="vendor_id" id="vendor_id" disabled>
                <option value="">-- Choose Vendor --</option>
                @foreach($dVendor AS $vendor)
                  <option value="{{ $vendor->id }}" @if($data->vendor_id == $vendor->id) selected @endif>{{ $vendor->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Area</label>
            <div>
              <select class="form-control" name="area_id" id="area_id" disabled>
                <option value="">-- Choose Area --</option>
                @foreach($dArea AS $area)
                  <option value="{{ $area->id }}" @if($data->area_id == $area->id) selected @endif>{{ $area->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">City</label>
            <div>
              <select class="form-control" name="city_id" id="city_id" disabled>
                <option value="">-- Choose City --</option>
                @foreach($dCity AS $city)
                  <option value="{{ $city->id }}" @if($data->city_id == $city->id) selected @endif>{{ $city->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <div>
              <textarea class="form-control" name="remarks" id="remarks" disabled>{{ $data->remarks }}</textarea>
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
