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
          <input type="hidden" class="" name="project_id" id="project_id" value="" />
          <div class="row">
            @if(Auth::user()->usertype_id == 1)
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Employee</label>
                <div>
                  <input type="text" class="form-control needed" name="karyawan_name" id="lookup_karyawan" value="" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Please Fill</span>
                </div>
              </div>
            </div>
            @endif
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Project</label>
                <div>
                  <input type="text" class="form-control needed" name="project_name" id="lookup_project" value="" autocomplete="off"/>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            @if(Auth::user()->usertype_id != 1)
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Purchase No</label>
                <div>
                  <input type="text" class="form-control" name="pr_no" id="pr_no" placeholder="" autocomplete="off" readonly>
                </div>
              </div>
            </div>
            @endif
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ date('d/m/Y') }}">
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Dipilih</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Due Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="due_date" id="due_date" placeholder="" autocomplete="off" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Description</label>
                <div>
                  <textarea class="form-control editor" name="description" id="description"></textarea>
                </div>
              </div>
            </div>
          </div>
          <section id="tools">
            <h4 class="page-header">Items
              <!-- <button type="button" class="btn btn-primary pull-right btn-xs" id="btnListTools"><i class="fa fa-plus"></i> Add</button> -->
            </h4>
            <div class="table-responsive">
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
                <tr>
                  <td colspan="7" class="text-center">Empty</td>
                </tr>
                </tbody>
                <tfoot>
                <tr  id="toolsTotal" style=" display: none; ">
                  <td colspan="5" align="right"><strong>Total:</strong></td>
                  <td><input type="text" class="form-control type" name="total" value="" id="total" readonly></td>
                </tr>
                <tr>
                  <td colspan="7"><button type="button" id="tambahBaris" class="btn btn-default btn-xs">Tambah Baris</button></td>
                </tr>
                </tfoot>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
$(document).ready(function(){

  var urut = 0;

  $(".editor").wysihtml5();

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
              list[item.name+'-project'] = item.project.name;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#karyawan_id").val(list[data]);
        $("#project").val(list[data+'-project']);
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
