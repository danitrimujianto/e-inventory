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
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker needed" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Start Date</label>
                <div>
                  <input type="text" class="form-control datepicker needed" name="start_date" id="start_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->start_date) }}">
                  <span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
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
                  <th>Problem</th>
                  <th>Condition</th>
                  <th>Merk</th>
                  <th>Serial Number</th>
                  <th>Imei</th>
                  <th>Estimate Price</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <tbody id="listTools">
                <?php $detail = false; $total = 0; ?>
                @if($data->ServiceDetail->count() > 0)
                <?php $detail = true; ?>
                @foreach($data->ServiceDetail AS $detil)
                <tr>
                  <td><input type="hidden" class="idTools" name="idTools[]" value="<?php echo $detil->tools_id; ?>" /><input type="text" class="form-control SearchEl" data-type="item" id="item" value="<?php echo $detil->tools->code." - ".$detil->tools->item; ?>" autocomplete="off"/></td>
                  <td><input type="text" class="form-control" value="<?php echo $detil->problem; ?>" id="" name="problem[]"/></td>
                  <td>
                  <select class="form-control goods_condition_id" name="goods_condition_id[]">
                    <option value="">-- Choose Condition --</option>
                    @foreach($dCondition AS $condition)
                      <option value="{{ $condition->id }}" <?php if($detil->condition_id === $condition->id) echo "selected"; ?>>{{ $condition->name }}</option>
                    @endforeach
                  </select>
                  </td>
                  <td><input type="text" class="form-control merk" value="<?php echo $detil->tools->merk; ?>" id="" readonly /></td>
                  <td><input type="text" class="form-control lookupTool serial_number" d-position="serial_number"  value="<?php echo $detil->tools->serial_number; ?>" /></td>
                  <td><input type="text" class="form-control lookupTool imei" d-position="imei" value="<?php echo $detil->tools->imei; ?>" id=""/></td>
                  <td><input type="text" class="form-control nominal text-right estprice" value="<?php echo HelpMe::cost2($detil->price); ?>" id="" name="price[]"/></td>
                  <td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td>
                </tr>
                <?php $total = $total+$detil->price; ?>
                @endforeach
                @else
                <tr>
                  <td colspan="8" class="text-center">Empty</td>
                </tr>
                @endif
                </tbody>
                <tbody class="disTotal" style="<?php if(!$detail) echo 'display:none;'; ?>">
                  <tr>
                    <td colspan="6" class="text-right">Total:</td>
                    <td class="subtotal text-right"><?php echo HelpMe::cost2($total); ?></td>
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

  
  $("body").on("keyup", ".estprice", function(){
    var t = 0, tot = 0;
    
    $(".estprice").each(function(){
      t = parseInt($(this).val().replace(/,/g,""));
      if(isNaN(t)){
        t = 0;
      }
      tot = tot+t;
    });
    $(".subtotal").html(nominal(tot));
  });

  var urut = 0;
  $("#tambahBaris").click(function(){
    urut++;
    var listTools = $('#listTools');
    var el ='<tr><td><input type="hidden" class="idTools" name="idTools[]" value="" /><input type="text" class="form-control SearchEl" data-type="item" id="item" value="" autocomplete="off"/></td><td><input type="text" class="form-control" value="" id="" name="problem[]"/></td><td>'+$('#conditionList').html()+'</td><td><input type="text" class="form-control merk" value="" id="" readonly /></td><td><input type="text" class="form-control lookupTool serial_number" d-position="serial_number"  value="" /></td><td><input type="text" class="form-control lookupTool imei" d-position="imei" value="" id=""/></td><td><input type="text" class="form-control nominal text-right estprice" value="" id="" name="price[]"/></td><td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td></tr>';


    var chekEmpty = listTools.find('#item').length;
    if(chekEmpty == 0){
      listTools.html(el);
      $('.disTotal').show();
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
    { listTools.html(el); 
      $('.disTotal').hide(); }

    
    var t = 0, tot = 0;
    
    $(".estprice").each(function(){
      t = parseInt($(this).val().replace(/,/g,""));
      if(isNaN(t)){
        t = 0;
      }
      tot = tot+t;
    });
    $(".subtotal").html(nominal(tot));
    
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
