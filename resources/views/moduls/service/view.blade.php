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
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}" readonly>
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Item</label>
                <div>
                  <input type="hidden" class="form-control" name="tools_id" id="tools_id" placeholder="" autocomplete="off" value="{{ $data->tools_id }}">
                  <input type="text" class="form-control itemSearch" name="item" id="item" placeholder="" autocomplete="off" value="{{ optional($data->tools)->item }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">ID Tools</label>
                <div>
                  <input type="text" class="form-control" name="code" id="code" placeholder="" autocomplete="off" value="{{ optional($data->tools)->code }}" readonly>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Serial Number</label>
                <div>
                  <input type="text" class="form-control serialSearch" name="serial_number" id="serial_number" placeholder="" autocomplete="off" value="{{ optional($data->tools)->serial_number }}" disabled>
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Imei</label>
                <div>
                  <input type="text" class="form-control imeiSearch" name="imei" id="imei" placeholder="" autocomplete="off" value="{{ optional($data->tools)->imei }}" disabled>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Start Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->start_date) }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Finish Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="finish_date" id="finish_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->finish_date) }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Problem</label>
                <div>
                  <input type="text" class="form-control" name="problem" id="problem" placeholder="" autocomplete="off" value="{{ $data->problem }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Service</label>
                <div>
                  <input type="text" class="form-control" name="service" id="service" placeholder="" autocomplete="off" value="{{ $data->service }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Condition</label>
                <div>
                  <select class="form-control" name="condition_id" disabled>
                    <option value="">-- Choose Condition --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}" @if($data->condition_id == $condition->id) selected @endif>{{ $condition->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">After</label>
                <div>
                  <select class="form-control" name="after_id" disabled>
                    <option value="">-- Choose After --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}" @if($data->after_id == $condition->id) selected @endif>{{ $condition->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <div>
              <textarea class="form-control" name="remarks" id="remarks" readonly>{{ $data->remarks }}</textarea>
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
