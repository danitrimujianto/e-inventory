@section('title', 'Report Stok Tools')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12">
      <table class="table table-hover">
        <tr>
          <th style="background-color: #605ca8; color: #FFFFFF; text-align: center; " class="text-center">Type</th>
          <?php $np = 0; ?>
          @foreach($data['project'] AS $pr)
          <th style="background-color: #605ca8; color: #FFFFFF; text-align: center; ">{{ $pr->name }}</th>
          <?php $grandTotalProject[$pr->id] = 0; $np++; ?>
          @endforeach
          <th style="background-color: #605ca8; color: #FFFFFF; text-align: center; " >Grand Total</th>
        </tr>
        <?php $nf = 0; ?>
        @foreach($data['type'] AS $ty)
        <?php $grandtotalrow = 0; ?>
          <tr class="bg-gray-active color-palette">
            <th style="background-color: #b5bbc8; color: #090909; text-align: center; ">{{ $ty->name }}</th>
            @foreach($data['project'] AS $pr)
            <th style="background-color: #b5bbc8; color: #090909; text-align: center; " class="text-center">{{ $data['jmlByProjectType'][$ty->id][$pr->id] }}</th>
            <?php
            $grandTotalProject[$pr->id] = ($grandTotalProject[$pr->id]+$data['jmlByProjectType'][$ty->id][$pr->id]);
            $grandtotalrow = $grandtotalrow+$data['jmlByProjectType'][$ty->id][$pr->id];
            ?>
            @endforeach
            <th style="background-color: #b5bbc8; color: #090909; text-align: center; " class="text-center">{{ $grandtotalrow }}</th>
          </tr>
          @foreach($data['city'][$ty->id] AS $ct)
          <?php $grandtotalrow = 0; ?>
          <tr class="bg-gray color-palette">
            <td style="background-color: #d2d6de; color: #090909; text-align: center; ">&nbsp;&nbsp;&nbsp;{{ $ct->name }}</td>
            @foreach($data['project'] AS $pr)
            <td style="background-color: #d2d6de; color: #090909; text-align: center; " class="text-center">{{ $data['jml'][$ty->id][$ct->id][$pr->id] }}</td>
            <?php $grandtotalrow = $grandtotalrow+$data['jml'][$ty->id][$ct->id][$pr->id]; ?>
            @endforeach
            <th style="background-color: #d2d6de; color: #090909; text-align: center; " class="text-center">{{ $grandtotalrow }}</th>
          </tr>
          @endforeach
        @endforeach
        <tr class="bg-light-blue color-palette">
          <td style="background-color: #3c8dbc; color: #FFFFFF; text-align: center; ">Grand Total</td>
          <?php $grandtotalrow = 0; ?>
          @foreach($data['project'] AS $pr)
          <td style="background-color: #3c8dbc; color: #FFFFFF; text-align: center; " class="text-center">{{ $grandTotalProject[$pr->id] }}</td>
          <?php $grandtotalrow = $grandtotalrow+$grandTotalProject[$pr->id]; ?>
          @endforeach
          <th style="background-color: #3c8dbc; color: #FFFFFF; text-align: center; " class="text-center">{{ $grandtotalrow }}</th>
        </tr>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
