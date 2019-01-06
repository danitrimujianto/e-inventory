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
                  <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="" autocomplete="off" value="{{ date('d/m/Y') }}">
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
                  <input type="text" class="form-control itemSearch" name="item" id="item" placeholder="" autocomplete="off" value="">
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
                <label for="name">Start Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="start_date" id="start_date" placeholder="" autocomplete="off" value="">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Finish Date</label>
                <div>
                  <input type="text" class="form-control datepicker" name="finish_date" id="finish_date" placeholder="" autocomplete="off" value="">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Problem</label>
                <div>
                  <input type="text" class="form-control" name="problem" id="problem" placeholder="" autocomplete="off" value="">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Service</label>
                <div>
                  <input type="text" class="form-control" name="service" id="service" placeholder="" autocomplete="off" value="">
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
                      <option value="{{ $condition->id }}">{{ $condition->name }}</option>
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
                      <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
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
                listData[item.item]['code'] = item.code;
                list.push(listData);
                return item.item;
    					}));
  				}
  			});
  		},
      afterSelect: function(data){
        $('#tools_id').val(listData[data]['id']);
        $('#code').val(listData[data]['code']);
        // console.log(listData[data]['']);
      }
  	});
  });
});

</script>
@endsection
