<?php
$search = "";
?>
<style>
.container {
    position: relative;
    width: 40%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.container:hover .image {
  opacity: 0.3;
}

.container:hover .middle {
  opacity: 1;
}

.text {
  background-color: #000;
  font-weight: bold;
  opacity: 0.3;
  color: white;
  font-size: 15px;
  padding: 12px 22px;
}

#avatar{
  display:none;
}

#img-avatar{
}
</style>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Data</h3>
      <div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $data->id }}">
        @method('PUT')
        @csrf
        <div class="box-body">
          <div class="form-group">
            <!-- <label for="email">Avatar</label> -->
            <div class="box-profile">
              <div class="container">
                <input type="hidden" name="file_lama" id="file_lama" value="{{ $data->avatar }}" />
                <input type="file" name="avatar" id="avatar" />
                <img class="profile-user-img img-responsive img-circle image" id="img-avatar" src="{{ HelpMe::cekImg($data->avatar) }}" alt="User profile picture" style=" width: 100px; height: 100px;">
                <div class="middle">
                  <div class="text"><a href="javascript: void(0)" id="UbahAvatar"><i class="fa fa-edit"></i> Ubah</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="email">Name</label>
            <div>
              <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" placeholder="" autocomplete="off">
            </div>
          </div>
          @if(Auth::user()->usertype_id != 1)
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <div>
              <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $data->karyawan->phone_number }}" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Project</label>
            <div>
              <select class="form-control" name="project_id" id="project_id">
                <option value="">-- Choose Project --</option>
                @foreach($dProject AS $project)
                  <option value="{{ $project->id }}" @if($data->karyawan->project_id == $project->id) selected='selected' @endif>{{ $project->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- <input type="hidden" name="homebasearea_id" value="{{ $data->karyawan->homebasearea_id }}"> -->
          <div class="form-group">
            <label for="name">Homebase Area</label>
            <div>
              <select class="form-control" name="homebasearea_id2" id="homebasearea_id" readonly disabled>
                <option value="">-- Choose Area --</option>
                @foreach($dArea AS $area)
                  <option value="{{ $area->id }}" @if($data->karyawan->homebasearea_id == $area->id) selected='selected' @endif>{{ $area->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Assignment Area</label>
            <div>
              <select class="form-control" name="assignmentarea_id" id="assignmentarea_id">
                <option value="">-- Choose Assignment --</option>
                @foreach($dCity AS $city)
                  <option value="{{ $city->id }}" @if($data->karyawan->assignmentarea_id == $city->id) selected='selected' @endif>{{ $city->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          @endif
          <div class="form-group">
            <label for="email">Email</label>
            <div>
              <input type="email" class="form-control" name="email" id="email" value="{{ $data->email }}" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <div>
              <input type="password" class="form-control" name="password" id="password" placeholder="" autocomplete="off">
  						<span style=" margin-top:0; margin-bottom: 0; clear:both; color: red;">Kosongkan jika tidak diganti</span>
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
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img-avatar').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function(){
  $('#img-avatar').each(function() {
        var maxWidth = 100; // Max width for the image
        var maxHeight = 100;    // Max height for the image
        var ratio = 0;  // Used for aspect ratio
        var width = $(this).width();    // Current image width
        var height = $(this).height();  // Current image height

        // Check if the current width is larger than the max
        if(width > maxWidth){
            ratio = maxWidth / width;   // get ratio for scaling image
            $(this).css("width", maxWidth); // Set new width
            $(this).css("height", height * ratio);  // Scale height based on ratio
            height = height * ratio;    // Reset height to match scaled image
            width = width * ratio;    // Reset width to match scaled image
        }

        // Check if current height is larger than max
        if(height > maxHeight){
            ratio = maxHeight / height; // get ratio for scaling image
            $(this).css("height", maxHeight);   // Set new height
            $(this).css("width", width * ratio);    // Scale width based on ratio
            width = width * ratio;    // Reset width to match scaled image
            height = height * ratio;    // Reset height to match scaled image
        }
    });

  $("#avatar").change(function() {
    readURL(this);
  });

  $("#UbahAvatar").click(function(){
    $("#avatar").click();
  });
});

</script>
@endsection
