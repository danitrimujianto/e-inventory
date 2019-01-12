<?php $search = ""; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add New</h3>
      <div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="code">ID Employee (NIK)</label>
            <div>
              <input type="text" class="form-control needed" name="id_karyawan" id="id_karyawan" placeholder="" autocomplete="off">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Name</label>
            <div>
              <input type="text" class="form-control" name="name" id="name" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Departemen</label>
            <div>
              <select class="form-control" name="departemen_id" id="departemen_id">
                <option value="">-- Choose Departemen --</option>
                @foreach($dDepartemen AS $departemen)
                  <option value="{{ $departemen->id }}">{{ $departemen->name }}</option>
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
                  <option value="{{ $position->id }}">{{ $position->position }}</option>
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
                  <option value="{{ $project->id }}">{{ $project->name }}</option>
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
                  <option value="{{ $area->id }}">{{ $area->name }}</option>
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
                  <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Phone Number</label>
            <div>
              <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Email</label>
            <div>
              <input type="text" class="form-control" name="email" id="email" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Status</label>
            <div>
              <select class="form-control" name="status" id="status">
                <option value="">-- Choose Status --</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
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
