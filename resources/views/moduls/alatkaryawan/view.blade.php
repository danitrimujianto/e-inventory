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
        <input type="hidden" name="id" value="{{ $data->id }}">
        @csrf
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Item</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->tools->item }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">ID Tools</label>
                <div>
                  <input type="text" class="form-control datepicker" autocomplete="off" value="{{ $data->tools->code }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Merk</label>
                <div>
                  <input type="text" class="form-control datepicker" autocomplete="off" value="{{ $data->tools->merk }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Type</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->tools->type }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Serial Number</label>
                <div>
                  <input type="text" class="form-control datepicker" autocomplete="off" value="{{ $data->tools->serial_number }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Imei</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->tools->imei }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Area</label>
                <div>
                  <input type="text" class="form-control datepicker" autocomplete="off" value="{{ $data->handover->toarea->name }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">City</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->karyawan->assignmentarea->name }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control datepicker" autocomplete="off" value="{{ $data->handover->project->name }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">NIK Karyawan</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->karyawan->id_karyawan }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Karyawan</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->karyawan->name }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Position</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ $data->karyawan->position->name }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Update Date</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->renew_date) }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Condition</label>
                <div>
                  <input type="text" class="form-control" autocomplete="off" value="{{ optional($data->condition)->name }}" readonly>
                </div>
              </div>
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
