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
          <input type="hidden" class="" name="karyawan_id" id="karyawan_id" value="{{ $data->karyawan_id }}" />
          @if(Auth::user()->usertype_id == 1)
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Employee</label>
                <div>
                  <input type="text" class="form-control needed" name="karyawan_name" id="lookup_karyawan" value="{{ $data->karyawan->name}}" autocomplete="off"/>
                  <!-- <select class="form-control needed" name="karyawan_id" id="karyawan_id">
                    <option value="">-- Choose Employee --</option>
                    @foreach($dKaryawan AS $karyawan)
                      <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                    @endforeach
                  </select> -->
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Please Fill</span>
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
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->tanggal) }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Purchase No</label>
                <div>
                  <input type="text" class="form-control" name="pr_no" id="pr_no" placeholder="" autocomplete="off" value="{{ $data->pr_no }}" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Due Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="due_date" id="due_date" placeholder="" autocomplete="off" value="{{ HelpMe::tgl_sql_to_indo($data->due_date) }}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Description</label>
                <div>
                  <textarea class="form-control" name="description" id="description">{{ $data->description }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <section id="tools">
            <h4 class="page-header">Items
              <!-- <button type="button" class="btn btn-primary pull-right btn-xs" id="btnListTools"><i class="fa fa-plus"></i> Add</button> -->
            </h4>
            <table class="table table-bordered">
                <tr>
                  <th>Item</th>
                  <th>Merk</th>
                  <th>Type</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Subtotal</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <tbody id="listTools">
                @php
                $total = 0;
                $totalDetail = count($data->purchase_detail);
                @endphp
                @if($totalDetail > 0)
                @foreach($data->purchase_detail AS $detail)
                <tr>
                  <td><input type="hidden" class="idTools" value="" /><input type="text" class="form-control" data-type="item" id="item" name="item[]" value="{{ $detail->item }}" autocomplete="off"/></td>
                  <td><input type="text" class="form-control merk" name="merk[]" value="{{ $detail->merk }}" id=""  /></td>
                  <td><input type="text" class="form-control type" name="type[]" value="{{ $detail->type }}" id="" /></td>
                  <td><input type="text" class="form-control quantity desimal" name="quantity[]" value="{{ HelpMe::cost2($detail->quantity) }}"  id="" /></td>
                  <td><input type="text" class="form-control price nominal" name="price[]" value="{{ HelpMe::cost2($detail->price) }}" id="" /></td>
                  <td><input type="text" class="form-control subtotal" name="subtotal[]" value="{{ HelpMe::cost2($detail->total) }}" id="" readonly/></td>
                  <td><button type="button" class="btn btn-danger btn-xs delRow"><i class="fa fa-remove"></i>&nbsp;Delete</button></td>
                </tr>
                @php
                $total = $total+$detail->total;
                @endphp
                @endforeach
                @else
                <tr>
                  <td colspan="7" class="text-center">Empty</td>
                </tr>
                @endif
                </tbody>
                <tfooter>
                <tr  id="toolsTotal" style=" @if($totalDetail == 0) display: none; @endif ">
                  <td colspan="5" align="right"><strong>Total:</strong></td>
                  <td><input type="text" class="form-control type" name="total" value="{{ HelpMe::cost2($total) }}" id="total" readonly></td>
                </tr>
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
