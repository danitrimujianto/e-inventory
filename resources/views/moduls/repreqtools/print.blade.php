@section('title', 'Report Request Tools')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12">
      <table class="table table-striped" style=" width: 100%; ">
        <thead>
        <tr>
          <th colspan="8"><h2>@yield('title')</h2></th>
          <th><h2>Periode: {{ }}</h2></th>
          <th colspan="2" style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
        <tr>
          <th bgcolor="#CCCCCC">NO.</th>
          <th bgcolor="#CCCCCC">DATE</th>
          <th bgcolor="#CCCCCC">PURCHASE NO.</th>
          <th bgcolor="#CCCCCC">REQUESTOR</th>
          <th bgcolor="#CCCCCC">PROJECT</th>
          <th bgcolor="#CCCCCC">ITEM</th>
          <th bgcolor="#CCCCCC">MERK</th>
          <th bgcolor="#CCCCCC">TYPE</th>
          <th bgcolor="#CCCCCC">QTY</th>
          <th bgcolor="#CCCCCC" style=" text-align: right; ">PRICE</th>
          <th bgcolor="#CCCCCC" style=" text-align: right; ">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 0; @endphp
        @foreach($data AS $d)
        @php $no++; @endphp
        <tr>
          <td>{{ $no.'.' }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->purchase_request->tanggal) }}</td>
          <td>{{ optional($d->purchase_request)->pr_no }}</td>
          <td>{{ optional($d->purchase_request->karyawan)->name }}</td>
          <td>{{ optional($d->purchase_request->project)->name }}</td>
          <td>{{ $d->item }}</td>
          <td>{{ $d->merk }}</td>
          <td>{{ $d->type }}</td>
          <td>{{ $d->quantity }}</td>
          <td style=" text-align: right; ">{{ HelpMe::cost2($d->price) }}</td>
          <td style=" text-align: right; ">{{ HelpMe::cost2($d->total) }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
