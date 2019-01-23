<?php $search = ""; ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Add New</h3>
      <div>
      <!-- form start -->
      <form id="fProcess" class="fProcess2" method="post" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="name">Name</label>
            <div>
              <input type="text" class="form-control needed karyawanSearch" name="name" id="name" placeholder="" autocomplete="off">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Tipe User</label>
            <div>
              <select class="form-control needed" name="usertype_id" id="usertype_id">
                <option value="">-- Choose Tipe User --</option>
                @foreach($dTipe AS $tipe)
                  <option value="{{ $tipe->id }}">{{ $tipe->type_name }}</option>
                @endforeach
              </select>
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Belum Dipilih</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Email</label>
            <div>
              <input type="text" class="form-control needed" name="email" id="email" placeholder="" autocomplete="off">
  						<span class="help-block2" style=" margin-top:0; margin-bottom: 0; clear:both;">Harus Diisi</span>
            </div>
          </div>
          <div class="form-group">
            <label for="name">Password</label>
            <div>
              <input type="password" class="form-control" name="password" id="password" placeholder="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="request_tools" id="request_tools" value="1" />
                Give access to <strong>Request New Tools</strong>
              </label>
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

  var listRecipient = {};
  $('body').on('keyup', '.karyawanSearch', function(){
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
              if(item.project.name){ listRecipient[item.name+'-projectname'] = item.project.name; }
              listRecipient[item.name+'-email'] = item.email;
              return item.name;
            }));
          }
        });
      },
      afterSelect: function(data){
        $("#name").val(data);
        $("#email").val(listRecipient[data+'-email']);
      }
    });
  });

});
</script>
@endsection
