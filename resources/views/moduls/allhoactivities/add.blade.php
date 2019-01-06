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
          @if(Auth::user()->usertype_id == 1)
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Sender</label>
                <div>
                  <select class="form-control needed" name="sender_id" id="sender_id">
                    <option value="">-- Choose Sender --</option>
                    @foreach($dKaryawan AS $karyawan)
                      <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                    @endforeach
                  </select>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
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
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
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
                  <select class="form-control needed" name="recipient_id" id="recipient_id">
                    <option value="">-- Choose Recipient --</option>
                    @foreach($dKaryawan AS $karyawan)
                      <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                    @endforeach
                  </select>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
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
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Delivery By</label>
                <div>
                  <select class="form-control" name="delivery_id" id="delivery_id">
                    <option value="">-- Choose Delivery --</option>
                    @foreach($dDelivery AS $delivery)
                      <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                    @endforeach
                  </select>
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">From Area</label>
                <div>
                  <select class="form-control" name="fromarea_id" id="fromarea_id">
                    <option value="">-- Choose From Area --</option>
                    @foreach($dArea AS $area)
                      <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">To Area</label>
                <div>
                  <select class="form-control" name="toarea_id" id="toarea_id">
                    <option value="">-- Choose To Area --</option>
                    @foreach($dArea AS $area)
                      <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                  </select>
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
                <!-- <tr>
                  <td>&nbsp;</td>
                  <td><input type="text" class="form-control SearchEl" data-type="code" id="code" value="" /></td>
                  <td><input type="text" class="form-control SearchEl" data-type="item" value="" /></td>
                  <td><input type="text" class="form-control" value="" readonly /></td>
                  <td><input type="text" class="form-control" value="" readonly/></td>
                  <td><input type="text" class="form-control" value="" readonly/></td>
                  <td><input type="text" class="form-control" value="" readonly/></td>
                  <td><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i>&nbsp;Hapus</button></td>
                </tr> -->
                </tbody>
                <tfooter>
                <tr>
                  <td colspan="7"><button type="button" id="tambahBaris" class="btn btn-default btn-xs">Tambah Baris</button></td>
                </tr>
                </tfooter>
              </table>
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
    var el ='<tr><td><input type="hidden" class="idTools" name="idTools[]" value="" /><input type="text" class="form-control SearchEl" data-type="item" id="item" value="" autocomplete="off"/></td><td>'+$('#conditionList').html()+'</td><td><input type="text" class="form-control merk" value="" id="" readonly /></td><td><input type="text" class="form-control type" value="" id="" readonly/></td><td><input type="text" class="form-control serial_number" value=""  id="" readonly/></td><td><input type="text" class="form-control imei" value="" id="" readonly/></td><td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td></tr>';


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
  				data: 'sf=as&sq=' + query,
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

});
</script>
@endsection
