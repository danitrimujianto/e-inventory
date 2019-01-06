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
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}">
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
                  <input type="text" class="form-control itemSearch" name="item" id="item" placeholder="" autocomplete="off" value="{{ $data->tools->item }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">ID Tools</label>
                <div>
                  <input type="text" class="form-control" name="code" id="code" placeholder="" autocomplete="off" value="{{ $data->tools->code }}" readonly>
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

  var urut = 0;

  $('#btnListTools').click(function(){
    modalPage('', '/tools/list', 'Tools', 80);
  });
  var list = {};
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
              list[item.name] = item.id;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#karyawan_id").val(list[data]);
      }
    });
  });

  $("#tambahBaris").click(function(){
    urut++;
    var listTools = $('#listTools');
    var el ='<tr><td><input type="hidden" class="idTools" value="" /><input type="text" class="form-control" data-type="item" id="item" name="item[]" value="" autocomplete="off"/></td><td><input type="text" class="form-control merk" name="merk[]" value="" id=""  /></td><td><input type="text" class="form-control type" name="type[]" value="" id="" /></td><td><input type="text" class="form-control quantity desimal" name="quantity[]" value="0"  id="" /></td><td><input type="text" class="form-control price nominal" name="price[]" value="0" id="" /></td><td><input type="text" class="form-control subtotal" name="subtotal[]" value="0" id="" readonly/></td><td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td></tr>';


    var chekEmpty = listTools.find('#item').length;
    if(chekEmpty == 0){
      listTools.html(el);
      $('#toolsTotal').show();
    }else{
      listTools.append(el);
    }
    // listTools.find('.goods_condition_id').prop('disabled', false);
    // var er = $(this).parent('td').parent('tr').parent('tfooter').parent('table').find('#listTools').find('.goods_condition_id').prop('disabled');
    // alert(er);

  });
  var total = 0;

  $('body').on('click', '.delRow', function(){
    var listTools = $('#listTools');
    var el ='<tr><td colspan="6" class="text-center">Empty</td></tr>';

    $(this).parent('td').parent('tr').remove();
    var chekEmpty = listTools.find('#item').length;

    if(chekEmpty == 0)
    { listTools.html(el); $('#toolsTotal').hide(); }

    total = hitungTotal();
    $('#total').val(nominal(total));

    urut--;
  });
  $('body').on('keyup', '.quantity', function(){
    var el = $(this).parent('td').parent('tr');
    var qty = parseInt($(this).val().trim().replace(".", ""));
    var price = parseInt(el.find('.price').val().trim().replace(/,/g, ""));
    var subtotal = parseInt(0);
    if(qty >= 0 && price >= 0)
    {
      subtotal = qty*price;
    }

    el.find('.subtotal').val(nominal(subtotal));
    total = hitungTotal();
    $('#total').val(nominal(total));
  });

  $('body').on('keyup', '.price', function(){
    var el = $(this).parent('td').parent('tr');
    var qty = parseInt(el.find('.quantity').val().replace(".", ""));
    var price = parseInt($(this).val().replace(/,/g, ""));
    var subtotal = 0;
    if(qty >= 0 && price >= 0)
    {
      subtotal = qty*price;
    }
    el.find('.subtotal').val(nominal(subtotal));
    total = hitungTotal();
    $('#total').val(nominal(total));
    // alert(total);
  });
});
function hitungTotal(){
  // $(".subtotal").length;
  var val = 0, sub = 0;
  $('.subtotal').each(function(){
    sub = $(this).val().trim().replace(/,/g, "");
    val = parseInt(val)+parseInt(sub);
  });

  return val;
}
</script>
@endsection
