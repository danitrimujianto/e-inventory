<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Welcome</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h4>Hello {{ Auth::user()->name }}, You currently in {{ Auth::user()->tipeuser->type_name }} page</h4>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
<!-- /.row -->
