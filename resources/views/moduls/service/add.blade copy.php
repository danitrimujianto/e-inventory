<?php $search = ""; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add New</h3>
      </div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <input type="hidden" class="" name="karyawan_id" id="karyawan_id" value="{{ Auth::user()->karyawan_id }}" />
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker needed" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ date('d/m/Y') }}">
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
                  <input type="hidden" class="form-control" name="tools_id" id="tools_id" placeholder="" autocomplete="off" value="">
                  <input type="text" class="form-control itemSearch needed" name="item" id="item" placeholder="" autocomplete="off" value="">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">ID Tools</label>
                <div>
                  <input type="text" class="form-control" name="code" id="code" placeholder="" autocomplete="off" value="" readonly>
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
                  <input type="text" class="form-control serialSearch" name="serial_number" id="serial_number" placeholder="" autocomplete="off" value="">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Imei</label>
                <div>
                  <input type="text" class="form-control imeiSearch" name="imei" id="imei" placeholder="" autocomplete="off" value="">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Problem</label>
                <div>
                  <input type="text" class="form-control needed" name="problem" id="problem" placeholder="" autocomplete="off" value="">
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Service</label>
                <div>
                  <input type="text" class="form-control needed" name="service" id="service" placeholder="" autocomplete="off" value="">
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Condition</label>
                <div>
                  <select class="form-control needed" name="condition_id">
                    <option value="">-- Choose Condition --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                  </select>
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">After</label>
                <div>
                  <select class="form-control needed" name="after_id">
                    <option value="">-- Choose After --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                  </select>
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
                  <input type="text" class="form-control datepicker needed" name="start_date" id="start_date" placeholder="" autocomplete="off" value="">
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Estimate Price</label>
                <div>
                  <input type="text" class="form-control nominal needed" name="price" id="price" placeholder="" autocomplete="off" value="">
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <div>
              <textarea class="form-control needed" name="remarks" id="remarks"></textarea>
              <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>

          
          <div class="row" style=" display:none; ">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Condition</label>
                <div id="conditionList">
                  <select class="form-control goods_condition_id" name="goods_condition_id[]" disabled="true">
                    <option value="">-- Choose Condition --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <section id="tools">
            <h4 class="page-header">Tools
              <!-- <button type="button" class="btn btn-primary pull-right btn-xs" id="btnListTools"><i class="fa fa-plus"></i> Add</button> -->
            </h4>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                  <th>Item</th>
                  <th>Condition</th>
                  <th>Merk</th>
                  <th>Type</th>
                  <th>Serial Number</th>
                  <th>Imei</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <tbody id="listTools">
                <tr>
                  <td colspan="7" class="text-center">Empty</td>
                </tr>
                </tbody>
                <tfooter>
                <tr>
                  <td colspan="7"><button type="button" id="tambahBaris" class="btn btn-default btn-xs">Tambah Baris</button></td>
                </tr>
                </tfooter>
              </table>
            </div>
          </section>
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
              console.log(data);
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
        // console.log(listData[data]);
      }
  	});
  });

  var urut = 0;
  $("#tambahBaris").click(function(){
    urut++;
    var listTools = $('#listTools');
    var el ='<tr><td><input type="hidden" class="idTools" name="idTools[]" value="" /><input type="text" class="form-control SearchEl" data-type="item" id="item" value="" autocomplete="off"/></td><td>'+$('#conditionList').html()+'</td><td><input type="text" class="form-control merk" value="" id="" readonly /></td><td><input type="text" class="form-control type" value="" id="" readonly/></td><td><input type="text" class="form-control lookupTool serial_number" d-position="serial_number"  value="" /></td><td><input type="text" class="form-control lookupTool imei" d-position="imei" value="" id=""/></td><td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td></tr>';


    var chekEmpty = listTools.find('#item').length;
    if(chekEmpty == 0){
      listTools.html(el);
    }else{
      listTools.append(el);
    }
    listTools.find('.goods_condition_id').prop('disabled', false);
    var er = $(this).parent('td').parent('tr').parent('tfooter').parent('table').find('#listTools').find('.goods_condition_id').prop('disabled');
    // alert(er);

  });

  $('body').on('click', '.delRow', function(){
    var listTools = $('#listTools');
    var el ='<tr><td colspan="6" class="text-center">Empty</td></tr>';

    $(this).parent('td').parent('tr').remove();
    var chekEmpty = listTools.find('#item').length;

    if(chekEmpty == 0)
    { listTools.html(el); }

    urut--;
  });

  $('body').on('keyup', '.SearchEl', function(){
    $(this).typeahead({
  		source: function (query, result) {
        $.ajax({
  				url: "/tools/search/mutasi",
  				data: 'sf=items&sq=' + query,
  				dataType: "json",
  				type: "GET",
  				success: function (data) {
    					result($.map(data, function (item) {
    						return item.code+" - "+item.item;
    					}));
  				}
  			});
  		},
      afterSelect: function(data){

      }
  	});
  });

  var listBarang = {};
  $('body').on('keyup', '.lookupTool', function(){
    var pos = $(this).attr("d-position");
    $(this).typeahead({
  		source: function (query, result) {
        $.ajax({
  				url: "/tools/search/mutasi",
  				data: 'sf='+pos+'&sq=' + query,
  				dataType: "json",
  				type: "GET",
  				success: function (data) {
            console.log(data);
    					result($.map(data, function (item) {
    						return item[pos];
    					}));
  				}
  			});
  		},
      afterSelect: function(data){

      }
  	});
  });

  $('body').on('change', '.SearchEl', function(){
    var current = $(this).typeahead("getActive");
    if (current) {
      var code = current.split("-")[0].trim();
      var el = $(this).parent('td').parent('tr');
      // alert(el);
      $.ajax({
        url: "/tools/select",
        data: 'sf=code&sq=' + code,
        dataType: "json",
        type: "GET",
        success: function (data) {

          el.find('.idTools').val(data.id);
          el.find('.merk').val(data.merk);
          el.find('.type').val(data.type);
          el.find('.serial_number').val(data.serial_number);
          el.find('.imei').val(data.imei);

        }
      });
    } else {
      // Nothing is active so it is a new value (or maybe empty value)
    }
  });

  $('body').on('change', '.lookupTool', function(){
  // alert(code);
    var current = $(this).typeahead("getActive");
    if (current) {
      var pos = $(this).attr("d-position");
      var code = current.split("-")[0].trim();
      var el = $(this).parent('td').parent('tr');
      // alert(code);
      $.ajax({
        url: "/tools/select",
        data: 'sf='+pos+'&sq=' + code,
        dataType: "json",
        type: "GET",
        success: function (data) {

          el.find('.idTools').val(data.id);
          el.find('.SearchEl').val(data.code+" - "+data.item);
          el.find('.merk').val(data.merk);
          el.find('.type').val(data.type);
          el.find('.serial_number').val(data.serial_number);
          el.find('.imei').val(data.imei);

        }
      });
    } else {
      // Nothing is active so it is a new value (or maybe empty value)
    }
  });
});

</script>
@endsection
