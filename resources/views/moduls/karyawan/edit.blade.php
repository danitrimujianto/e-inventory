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
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="code">ID Employee (NIK)</label>
            <div>
              <input type="text" class="form-control needed" name="id_karyawan" id="id_karyawan" placeholder="" autocomplete="off" value="{{ $data->id_karyawan }}">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <div>
              <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off" value="{{ $data->name }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Departemen</label>
            <div>
              <select class="form-control" name="departemen_id" id="departemen_id">
                <option value="">-- Choose Departemen --</option>
                @foreach($dDepartemen AS $departemen)
                  <option value="{{ $departemen->id }}" @if($departemen->id == $data->departemen_id) selected @endif>{{ $departemen->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Position</label>
            <div>
              <select class="form-control" name="position_id" id="position_id">
                <option value="">-- Choose Position --</option>
                @foreach($dPosition AS $position)
                  <option value="{{ $position->id }}" @if($position->id == $data->position_id) selected @endif>{{ $position->position }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Project</label>
            <div>
              <select class="form-control" name="project_id" id="project_id">
                <option value="">-- Choose Project --</option>
                @foreach($dProject AS $project)
                  <option value="{{ $project->id }}" @if($project->id == $data->project_id) selected @endif>{{ $project->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Homebase Area</label>
            <div>
              <select class="form-control" name="homebasearea_id" id="homebasearea_id">
                <option value="">-- Choose Area --</option>
                @foreach($dArea AS $area)
                  <option value="{{ $area->id }}" @if($area->id == $data->homebasearea_id) selected @endif>{{ $area->name }}</option>
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
                  <option value="{{ $city->id }}" @if($city->id == $data->assignmentarea_id) selected @endif>{{ $city->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Phone Number</label>
            <div>
              <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" autocomplete="off" value="{{ $data->phone_number }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Email</label>
            <div>
              <input type="text" class="form-control" name="email" id="email" placeholder="" autocomplete="off" value="{{ $data->email }}">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Status</label>
            <div>
              <select class="form-control" name="status" id="status">
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
          <button type="button" class="btn btn-success" id="saveButton"><i class="fa fa-save"></i>&nbsp;Save</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
