<?php
$search = "";
$fromcity_id = "";
if(Auth::user()->usertype_id == 4){
$karyawan = \App\Karyawan::find(Auth::user()->karyawan_id);
$fromcity_id = $karyawan->assignmentarea_id;
}
?>
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
        <input type="hidden" class="" name="recipient_id" id="recipient_id" value="" />
        <input type="hidden" class="" name="delivery_id" id="delivery_id" value="" />
        <input type="hidden" class="" name="project_id" id="project_id" value="" />
        <input type="hidden" class="" name="fromcity_id" id="fromcity_id" value="{{ $fromcity_id }}" />
        <input type="hidden" class="" name="tocity_id" id="tocity_id" value="" />
        <div class="box-body">
          @if(Auth::user()->usertype_id == 1)
          <input type="hidden" class="" name="sender_id" id="sender_id" value="{{ Auth::user()->karyawan_id }}" />
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Sender</label>
                <div>
                  <input type="text" class="form-control needed" name="karyawan_name" id="lookup_karyawan" value="" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" placeholder="" autocomplete="off" value="{{ date('d/m/Y') }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Outgoing No</label>
                <div>
                  <input type="text" class="form-control" name="outgoing_no" id="outgoing_no" placeholder="" autocomplete="off" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Recipient</label>
                <div>
                  <input type="text" class="form-control needed" name="recipient_name" id="lookup_recipient" value="" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control needed" name="project_name" id="lookup_project" value="" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Delivery By</label>
                <div>
                  <input type="text" class="form-control needed" name="delivery_name" id="lookup_delivery" value="" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Receipt No</label>
                  <div>
                    <input type="text" class="form-control" name="receipt_no" id="receipt_no" placeholder="" autocomplete="off">
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            @if(Auth::user()->usertype_id == 1)
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">From City</label>
                <div>
                  <input type="text" class="form-control needed" name="fromcity_name" id="fromcity_name" value="" autocomplete="off" readonly/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            @endif
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">To City</label>
                <div>
                  <input type="text" class="form-control needed" name="tocity_name" id="tocity_name" value="" autocomplete="off" readonly/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
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

  var urut = 0;

  $('#btnListTools').click(function(){
    modalPage('', '/tools/list', 'Tools', 80);
  });

  $("#tambahBaris").click(function(){
    urut++;
    var listTools = $('#listTools');
    var el ='<tr><td><input type="hidden" class="idTools" name="idTools[]" value="" /><input type="text" class="form-control SearchEl" data-type="item" id="item" value="" autocomplete="off"/></td><td>'+$('#conditionList').html()+'</td><td><input type="text" class="form-control merk" value="" id="" readonly /></td><td><input type="text" class="form-control type" value="" id="" readonly/></td><td><input type="text" class="form-control lookupTool" d-position="serial_number"  value="" /></td><td><input type="text" class="form-control lookupTool" d-position="imei" value="" id=""/></td><td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td></tr>';


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
    var sender_id = $('#sender_id').val();
    $(this).typeahead({
  		source: function (query, result) {
        $.ajax({
  				url: "/tools/search/mutasi",
  				data: 'sender_id='+sender_id+'&sf=items&sq=' + query,
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

  var listKaryawan = {};
  $('body').on('keyup', '#lookup_karyawan', function(){
    $(this).typeahead({
      source: function (query, result) {
        // alert('asd');
        $.ajax({
          url: "/karyawan/search",
          data: 'sf=name&sq=' + query,
          dataType: "json",
          type: "GET",
          success: function (data) {
            // console.log(data);
            result($.map(data, function (item) {
              listKaryawan[item.name] = item.id;
              listKaryawan[item.name+'-city'] = item.assignmentarea.name;
              listKaryawan[item.name+'-idcity'] = item.assignmentarea.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#sender_id").val(listKaryawan[data]);
        $("#fromcity_name").val(listKaryawan[data+'-city']);
        $("#fromcity_id").val(listKaryawan[data+'-idcity']);
      }
    });
  });

  var listRecipient = {};
  $('body').on('keyup', '#lookup_recipient', function(){
    $(this).typeahead({
      source: function (query, result) {
        // alert('asd');
        $.ajax({
          url: "/karyawan/search",
          data: 'sf=name&sq=' + query,
          dataType: "json",
          type: "GET",
          success: function (data) {
            // console.log(data);
            result($.map(data, function (item) {
              listRecipient[item.name] = item.id;
              listRecipient[item.name+'-city'] = item.assignmentarea.name;
              listRecipient[item.name+'-idcity'] = item.assignmentarea.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#recipient_id").val(listRecipient[data]);
        $("#tocity_name").val(listRecipient[data+'-city']);
        $("#tocity_id").val(listRecipient[data+'-idcity']);
      }
    });
  });

  var listDelivery = {};
  $('body').on('keyup', '#lookup_delivery', function(){
    $(this).typeahead({
      source: function (query, result) {
        // alert('asd');
        $.ajax({
          url: "/delivery/search",
          data: 'sf=name&sq=' + query,
          dataType: "json",
          type: "GET",
          success: function (data) {
            // console.log(data);
            result($.map(data, function (item) {
              listDelivery[item.name] = item.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#delivery_id").val(listDelivery[data]);
      }
    });
  });

  var listProject = {};
  $('body').on('keyup', '#lookup_project', function(){
    $(this).typeahead({
      source: function (query, result) {
        // alert('asd');
        $.ajax({
          url: "/project/search",
          data: 'sf=name&sq=' + query,
          dataType: "json",
          type: "GET",
          success: function (data) {
            // console.log(data);
            result($.map(data, function (item) {
              listProject[item.name] = item.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#project_id").val(listProject[data]);
      }
    });
  });

  var listFromArea = {};
  $('body').on('keyup', '#lookup_fromarea', function(){
    $(this).typeahead({
      source: function (query, result) {
        // alert('asd');
        $.ajax({
          url: "/area/search",
          data: 'sf=name&sq=' + query,
          dataType: "json",
          type: "GET",
          success: function (data) {
            // console.log(data);
            result($.map(data, function (item) {
              listFromArea[item.name] = item.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#fromarea_id").val(listFromArea[data]);
      }
    });
  });

  var listToCity = {};
  $('body').on('keyup', '#lookup_tocity', function(){
    // alert('asd');
    $(this).typeahead({
      source: function (query, result) {
        // alert('asd');
        $.ajax({
          url: "/city/search",
          data: 'sf=name&sq=' + query,
          dataType: "json",
          type: "GET",
          success: function (data) {
            // console.log(data);
            result($.map(data, function (item) {
              listToCity[item.name] = item.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#tocity_id").val(listToCity[data]);
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
