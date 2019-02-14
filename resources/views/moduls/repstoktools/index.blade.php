<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <button class="btn btn-danger " id="excelButton"><i class="fa fa-file-excel-o"></i> Excel</button>
        <button class="btn btn-primary " id="printButton"><i class="fa fa-print"></i> Print</button>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr class="bg-purple-active color-palette">
            <th class="text-center">Type</th>
            <?php $np = 0; ?>
            @foreach($data['project'] AS $pr)
            <th class="text-center">{{ $pr->name }}</th>
            <?php $grandTotalProject[$pr->id] = 0; $np++; ?>
            @endforeach
            <th class="text-center" >Office</th>
            <th class="text-center">Grand Total</th>
          </tr>
          <?php $nf = 0; ?>
          <?php $grandTotalOffice = 0; ?>
          @foreach($data['type'] AS $ty)
          <?php $grandtotalrow = 0; ?>
            <tr class="bg-gray-active color-palette">
              <th>{{ $ty->type }}</th>
              @foreach($data['project'] AS $pr)
              <th class="text-center">{{ $data['jmlByProjectType'][$ty->id][$pr->id] }}</th>
              <?php
              $grandTotalProject[$pr->id] = ($grandTotalProject[$pr->id]+$data['jmlByProjectType'][$ty->id][$pr->id]);
              $grandtotalrow = $grandtotalrow+$data['jmlByProjectType'][$ty->id][$pr->id];
              ?>
              @endforeach
              <?php
                $grandtotalrow = $grandtotalrow+$data['jmlOffice'][$ty->id];
                $grandTotalOffice = $grandTotalOffice+$data['jmlOffice'][$ty->id];
              ?>
              <th class="text-center">{{ $data['jmlOffice'][$ty->id] }}</th>
              <th class="text-center">{{ $grandtotalrow }}</th>
            </tr>
            @foreach($data['city'][$ty->id] AS $ct)
            <?php $grandtotalrow = 0; ?>
            <tr class="bg-gray color-palette">
              <td>&nbsp;&nbsp;&nbsp;{{ $ct->name }}</td>
              @foreach($data['project'] AS $pr)
              <td class="text-center">{{ $data['jml'][$ty->id][$ct->id][$pr->id] }}</td>
              <?php $grandtotalrow = $grandtotalrow+$data['jml'][$ty->id][$ct->id][$pr->id]; ?>
              @endforeach
              <th class="text-center">&nbsp;</th>
              <th class="text-center">{{ $grandtotalrow }}</th>
            </tr>
            @endforeach
          @endforeach
          <tr class="bg-light-blue color-palette">
            <td>Grand Total</td>
            <?php $grandtotalrow = 0; ?>
            @foreach($data['project'] AS $pr)
            <td class="text-center">{{ $grandTotalProject[$pr->id] }}</td>
            <?php $grandtotalrow = $grandtotalrow+$grandTotalProject[$pr->id]; ?>
            @endforeach
            <?php
              $grandtotalrow = $grandtotalrow+$grandTotalOffice;
            ?>
            <th class="text-center">{{ $grandTotalOffice }}</th>
            <th class="text-center">{{ $grandtotalrow }}</th>
          </tr>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
