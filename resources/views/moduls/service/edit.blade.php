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
          <input type="hidden" class="" name="karyawan_id" id="karyawan_id" value="{{ Auth::user()->karyawan_id }}" />
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Item</label>
                <div>
                  <input type="hidden" class="form-control" name="tools_id" id="tools_id" placeholder="" autocomplete="off" value="{{ $data->tools_id }}">
                  <input type="text" class="form-control itemSearch" name="item" id="item" placeholder="" autocomplete="off" value="{{ optional($data->tools)->item }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div> -->

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
                  <input type="text" class="form-control serialSearch" name="serial_number" id="serial_number" placeholder="" autocomplete="off" value="{{ optional($data->tools)->serial_number }}">
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Imei</label>
                <div>
                  <input type="text" class="form-control imeiSearch" name="imei" id="imei" placeholder="" autocomplete="off" value="{{ optional($data->tools)->imei }}">
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
                  <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->start_date) }}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Finish Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="finish_date" id="finish_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->finish_date) }}">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Problem</label>
                <div>
                  <input type="text" class="form-control" name="problem" id="problem" placeholder="" autocomplete="off" value="{{ $data->problem }}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Service</label>
                <div>
                  <input type="text" class="form-control" name="service" id="service" placeholder="" autocomplete="off" value="{{ $data->service }}">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Condition</label>
                <div>
                  <select class="form-control" name="condition_id">
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
                  <select class="form-control" name="after_id">
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
  var list = [];
  var listData = {};
  var listSerial = [];
  var listDataSerial = {};
  var listImei = [];
  var listDataImei = {};

  $('body').on('keyup', '.serialSearch', function(){
    $(this).typeahead({
  		source: function (query, result) {
        $.ajax({
  				url: "/tools/search",
  				data: 'sf=serial_number&sq=' + query,
  				dataType: "json",
  				type: "GET",
  				success: function (data) {
    					result($.map(data, function (item) {
                listDataSerial[item.serial_number] = [];
                listDataSerial[item.serial_number]['id'] = item.id;
                listDataSerial[item.serial_number]['item'] = item.item;
                listDataSerial[item.serial_number]['serial_number'] = item.serial_number;
                listDataSerial[item.serial_number]['imei'] = item.imei;
                listDataSerial[item.serial_number]['code'] = item.code;
                listSerial.push(listDataSerial);
                return item.serial_number;
    					}));
  				}
  			});
  		},
      afterSelect: function(data){
        $('#tools_id').val(listDataSerial[data]['id']);
        $('#item').val(listDataSerial[data]['item']);
        $('#code').val(listDataSerial[data]['code']);
        $('#serial_number').val(listDataSerial[data]['serial_number']);
        $('#imei').val(listDataSerial[data]['imei']);
      }
  	});
  });

  $('body').on('keyup', '.imeiSearch', function(){
    $(this).typeahead({
  		source: function (query, result) {
        $.ajax({
  				url: "/tools/search",
  				data: 'sf=imei&sq=' + query,
  				dataType: "json",
  				type: "GET",
  				success: function (data) {
    					result($.map(data, function (item) {
                listDataImei[item.imei] = [];
                listDataImei[item.imei]['id'] = item.id;
                listDataImei[item.imei]['item'] = item.item;
                listDataImei[item.imei]['serial_number'] = item.serial_number;
                listDataImei[item.imei]['imei'] = item.imei;
                listDataImei[item.imei]['code'] = item.code;
                listImei.push(listDataImei);
                return item.imei;
    					}));
  				}
  			});
  		},
      afterSelect: function(data){
        $('#tools_id').val(listDataImei[data]['id']);
        $('#item').val(listDataImei[data]['item']);
        $('#code').val(listDataImei[data]['code']);
        $('#serial_number').val(listDataImei[data]['serial_number']);
        $('#imei').val(listDataImei[data]['imei']);
      }
  	});
  });

  $('body').on('keyup', '.itemSearch', function(){
    $(this).typeahead({
  		source: function (query, result) {
        $.ajax({
  				url: "/tools/search",
  				data: 'sf=item&sq=' + query,
  				dataType: "json",
  				type: "GET",
  				success: function (data) {
    					result($.map(data, function (item) {
                listData[item.item] = [];
                listData[item.item]['id'] = item.id;
                listData[item.item]['item'] = item.item;
                listData[item.item]['serial_number'] = item.serial_number;
                listData[item.item]['imei'] = item.imei;
                listData[item.item]['code'] = item.code;
                list.push(listData);
                return item.item;
    					}));
  				}
  			});
  		},
      afterSelect: function(data){
        $('#tools_id').val(listData[data]['id']);
        $('#item').val(listData[data]['item']);
        $('#code').val(listData[data]['code']);
        $('#serial_number').val(listData[data]['serial_number']);
        $('#imei').val(listData[data]['imei']);
        // console.log(listData[data]['']);
      }
  	});
  });
});

</script>
@endsection
