@section('title', 'Report Service')
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
        <tr style="">
          <th>NO.</th>
          <th>ID Tools</th>
          <th>Items</th>
          <th>Serial Number</th>
          <th>Imei</th>
          <th>Problem</th>
          <th>Service</th>
          <th>Condition</th>
          <th>After</th>
          <th>Start Date</th>
          <th>Finish Date</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 0; @endphp
        @foreach($data AS $d)
        @php $no++; @endphp
        <tr>
          <td>{{ $no.'.' }}</td>
          <td>{{ optional($d->tools)->code }}</td>
          <td>{{ optional($d->tools)->item }}</td>
          <td>{{ optional($d->tools)->serial_number }}</td>
          <td>{{ optional($d->tools)->imei }}</td>
          <td>{{ $d->problem }}</td>
          <td>{{ $d->service }}</td>
          <td>{{ optional($d->condition)->name }}</td>
          <td>{{ optional($d->after)->name }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->start_date) }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->finish_date) }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
