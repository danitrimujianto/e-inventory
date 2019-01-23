@section('title', 'Report Request Tools')
<style>
.headerReport{
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
}
</style>
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12">
      <table style=" width: 100%; ">
        <tr>
          <th colspan="3" align="center"><h3 class="headerReport">@yield('title')</h3></th>
        </tr>
        <tr>
          <th colspan="3">Periode: {{ HelpMe::tampiltgl2($first_date).' s/d '.HelpMe::tampiltgl2($second_date) }}</th>
          <th colspan="3">@if(!empty($sq)) Filter by {{ $sf.' : '.$sq }} @else &nbsp; @endif</th>
          <th colspan="3" style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
      </table>
      <table class="table table-striped" style=" width: 100%; ">
        <thead>
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
