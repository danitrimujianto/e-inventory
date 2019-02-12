@section('title', 'Report Stok Tools')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12">
      <table class="table table-striped" style=" width: 100%; ">
        <thead>
        <tr>
          <th colspan="7"><h2>@yield('title')</h2></th>
          <th colspan="2" style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
        <tr style="">
          <th>NO.</th>
          <th>ID Tools</th>
          <th>Date</th>
          <th>Item</th>
          <th>Merk</th>
          <th>Type</th>
          <th>SN</th>
          <th>Imei</th>
          <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 0; @endphp
        @foreach($data AS $d)
        @php $no++; @endphp
        <tr>
          <td>{{ $no.'.' }}</td>
          <td>{{ $d->code }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->tgl) }}</td>
          <td>{{ $d->item }}</td>
          <td>{{ $d->merk }}</td>
          <td>{{ $d->type }}</td>
          <td>{{ $d->serial_number }}</td>
          <td>{{ $d->imei }}</td>
          <td>{{ HelpMe::cost($d->price) }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
