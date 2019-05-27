<?php $search = ""; ?>
<!-- Small boxes (Stat box) -->
<div class="alert alert-info alert-dismissible warn" style=" display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4 class="title"></h4>
  <span class="description">
  </span>
</div>
<div class="row">
    <!-- general form elements -->
      <form name="fProcess" id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="code">Date</label>
            <div>
              <input type="text" class="form-control needed datepickerjs" name="tgl" id="tgl" placeholder="" autocomplete="off" value="{{ date('d/m/Y') }}">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="code">Division</label>
                <div>
                  <select class="form-control needed" name="division_id" id="division_id">
                    <option value="">-- Choose Division --</option>
                    @foreach($dDivision AS $division)
                      <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                  </select>
      						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="code">Goods</label>
                <div>
                  <select class="form-control needed" name="barang_id" id="barang_id">
                    <option value="">-- Choose Goods --</option>
                    @foreach($dBarang AS $barang)
                      <option value="{{ $barang->id }}">{{ $barang->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Item</label>
            <div>
              <select class="form-control" name="item_id" id="itemChoose">
                <option value="">-- Choose Supplier --</option>
                @foreach($dItems AS $items)
                  <option value="{{ $items->id }}">{{ $items->item }}</option>
                @endforeach
              </select>
              <input type="hidden" class="form-control" name="item" id="item" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Merk</label>
            <div>
              <input type="text" class="form-control" name="merk" id="merk" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Type</label>
            <div>
              <input type="text" class="form-control" name="type" id="type" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Serial Number</label>
            <div>
              <input type="text" class="form-control" name="serial_number" id="serial_number" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Imei</label>
            <div>
              <input type="text" class="form-control" name="imei" id="imei" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Supplier</label>
            <div>
              <select class="form-control" name="supplier_id" id="supplier_id">
                <option value="">-- Choose Supplier --</option>
                @foreach($dSupplier AS $supplier)
                  <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Price</label>
            <div>
              <input type="text" class="form-control nominal" name="price" id="price" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="remarks">Remarks</label>
            <div>
              <textarea class="form-control" name="remarks" id="remarks"></textarea>
            </div>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <!-- <button type="button" class="btn btn-default" id="backButton"><i class="fa fa-reply"></i>&nbsp;Back</button> -->
          <button type="button" class="btn btn-success saveFormModal" id="saveFormModal"><i class="fa fa-save"></i>&nbsp;Save</button>
        </div>
      </form>
</div>
<!-- /.row (main row) -->
<script>
$(document).ready(function(){
  // $('#saveFormModal').click(function(){
  //   alert('asd');
  //
  // });
  $("body").on("change", "#itemChoose", function(){
    var id = $(this).val();
    $.ajax({
      url: "/requesttools/detail/getItem/"+id,
      type: "GET",
      data: "",
      dataType: "json",
      success: function(data)
      {
        $("#item").val(data.item);
        $("#merk").val(data.merk);
        $("#type").val(data.type);
        $("#price").val(nominal(data.price));
        // console.log(data);
      }
    });
  });

  $("body").on("click", ".saveFormModal", function(){
    // alert('asd');
    var data = $('#fProcess').serialize();
    $.ajax({
      url: "/tools/add/request",
      type: "POST",
      data: data,
      dataType: "json",
      success: function(data)
      {
        // console.log(data);
				// $.map(data, function (item) {
          if(data.status == "1"){
            $(".warn").show();
            $(".warn .title").html('<i class="icon fa fa-check"></i> '+data.description);
            document.fProcess.reset();
            $('#myModal').animate({ scrollTop: 0 }, 'slow');
            // $("#fProcess").reset();
          }else{
            $(".warn").show();
            $(".warn .title").html('<i class="icon fa fa-remove"></i> '+data.description);
          }
        // });
      }
    });
  });


});
</script>
