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
        <input type="hidden" class="" name="recipient_id" id="recipient_id" value="{{ $data->recipient_id }}" />
        <input type="hidden" class="" name="delivery_id" id="delivery_id" value="{{ $data->delivery_id }}" />
        <input type="hidden" class="" name="project_id" id="project_id" value="{{ $data->project_id }}" />
        <input type="hidden" class="" name="fromarea_id" id="fromarea_id" value="{{ $data->fromarea_id }}" />
        <input type="hidden" class="" name="tocity_id" id="tocity_id" value="{{ $data->tocity_id }}" />
        <div class="box-body">
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
                  <input type="text" class="form-control" name="outgoing_no" id="outgoing_no" placeholder="" autocomplete="off" value="{{ $data->outgoing_no }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Recipient</label>
                <div>
                  <input type="text" class="form-control needed" name="recipient_name" id="lookup_recipient" value="{{ $data->karyawan->name }}" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control needed project_name" name="project_name" id="lookup_project" value="{{ $data->project->name }}" autocomplete="off"/>
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
                  <input type="text" class="form-control needed" name="delivery_name" id="lookup_delivery" value="{{ optional($data->delivery)->name }}" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Receipt No</label>
                  <div>
                    <input type="text" class="form-control" name="receipt_no" id="receipt_no" placeholder="" autocomplete="off" value="{{ $data->receipt_no }}">
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="name">From Area</label>
                <div>
                  <input type="text" class="form-control needed" name="fromarea_name" id="lookup_fromarea" value="{{ optional($data->fromarea)->name }}" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">To City</label>
                <div>
                  <input type="text" class="form-control needed" name="tocity_name" id="lookup_tocity" value="{{ optional($data->tocity)->name }}" autocomplete="off" readonly/>
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
                <?php $tools = App\AllhoActivities::find($data->id)->AllhoDetail; ?>
                @foreach($tools AS $detail)
                <input type="hidden" name="id_detail[]" value="{{ $detail->id }}" />
                <tr>
                    <td><input type="hidden" class="idTools" name="idTools[]" value="{{ $detail->tools_id }}" /><input type="text" class="form-control SearchEl" data-type="item" id="item" value="{{ $detail->tools->code.' - '.$detail->tools->item }}" autocomplete="off"/></td>
                    <td>
                      <select class="form-control goods_condition_id" name="goods_condition_id[]">
                        <option value="">-- Choose Condition --</option>
                        @foreach($dCondition AS $condition)
                          <option value="{{ $condition->id }}" @if($detail->goods_condition_id == $condition->id) selected @endif>{{ $condition->name }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td><input type="text" class="form-control merk" value="{{ $detail->tools->merk }}" id="" readonly /></td>
                    <td><input type="text" class="form-control type" value="{{ $detail->tools->type }}" id="" readonly/></td>
                    <td><input type="text" class="form-control serial_number" value="{{ $detail->tools->serial_number }}"  id="" readonly/></td>
                    <td><input type="text" class="form-control imei" value="{{ $detail->tools->imei }}" id="" readonly/></td>
                    <td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Hapus</button></td>
                </tr>
                @endforeach
                @if(!$tools)
                <tr>
                  <td colspan="6" class="text-center">Empty</td>
                </tr>
                @endif
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
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#sender_id").val(listKaryawan[data]);
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
              listRecipient[item.name+'-idproject'] = item.project_id;
              listRecipient[item.name+'-projectname'] = item.project.name;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#recipient_id").val(listRecipient[data]);
        $("#lookup_tocity").val(listRecipient[data+'-city']);
        $("#tocity_id").val(listRecipient[data+'-idcity']);
        $("#project_id").val(listRecipient[data+'-idproject']);
        $(".project_name").val(listRecipient[data+'-projectname']);
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

  var listToArea = {};
  $('body').on('keyup', '#lookup_toarea', function(){
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
              listToArea[item.name] = item.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#toarea_id").val(listToArea[data]);
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

});
</script>
@endsection
