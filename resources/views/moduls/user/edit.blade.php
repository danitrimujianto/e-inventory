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
            <label for="name">Name</label>
            <div>
              <input type="text" class="form-control needed" name="name" id="name" placeholder="" autocomplete="off" value="{{ $data->name }}">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Tipe User</label>
            <div>
              <select class="form-control needed" name="usertype_id" id="usertype_id">
                <option value="">-- Choose Tipe User --</option>
                @foreach($dTipe AS $tipe)
                  <option value="{{ $tipe->id }}" @if($data->usertype_id == $tipe->id) selected @endif>{{ $tipe->type_name }}</option>
                @endforeach
              </select>
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Belum Dipilih</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Email</label>
            <div>
              <input type="text" class="form-control needed" name="email" id="email" placeholder="" autocomplete="off" value="{{ $data->email }}">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Password</label>
            <div>
              <input type="password" class="form-control" name="password" id="password" placeholder="" autocomplete="off">
  						<span class="help-block" style=" margin-top:0; margin-bottom: 0; clear:both;">kosongkan bila tidak diganti</span>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="request_tools" id="request_tools" value="1" @if($data->request_tools == 1) checked @endif/>
                Give access to <strong>Request New Tools</strong>
              </label>
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
