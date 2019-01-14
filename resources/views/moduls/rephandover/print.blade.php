@section('title', 'Report Handover')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th colspan="14"><h2>@yield('title')</h2></th>
          <th colspan="2" style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
        <tr>
          <th bgcolor="#CCCCCC">NO.</th>
          <th bgcolor="#CCCCCC">DATE</th>
          <th bgcolor="#CCCCCC">OUTGOING NO.</th>
          <th bgcolor="#CCCCCC">ID TOOLS</th>
          <th bgcolor="#CCCCCC">ITEM</th>
          <th bgcolor="#CCCCCC">CONDITION</th>
          <th bgcolor="#CCCCCC">SN</th>
          <th bgcolor="#CCCCCC">IMEI</th>
          <th bgcolor="#CCCCCC">MERK</th>
          <th bgcolor="#CCCCCC">TYPE</th>
          <th bgcolor="#CCCCCC">SENDER</th>
          <th bgcolor="#CCCCCC">RECIPIENT</th>
          <th bgcolor="#CCCCCC">DELIVERY</th>
          <th bgcolor="#CCCCCC">PROJECT</th>
          <th bgcolor="#CCCCCC">FROM CITY</th>
          <th bgcolor="#CCCCCC">TO CITY</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 0; @endphp
        @foreach($data AS $d)
        @php $no++; @endphp
        <tr>
          <td>{{ $no.'.' }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->allhoactivities->tgl) }}</td>
          <td>{{ $d->allhoactivities->outgoing_no }}</td>
          <td>{{ $d->tools->code }}</td>
          <td>{{ $d->tools->item }}</td>
          <td>{{ optional($d->condition)->name }}</td>
          <td>{{ $d->tools->serial_number }}</td>
          <td>{{ $d->tools->imei }}</td>
          <td>{{ $d->tools->merk }}</td>
          <td>{{ $d->tools->type }}</td>
          <td>{{ optional($d->allhoactivities->sender)->name }}</td>
          <td>{{ optional($d->allhoactivities->karyawan)->name }}</td>
          <td>{{ optional($d->allhoactivities->delivery)->name }}</td>
          <td>{{ optional($d->allhoactivities->project)->name }}</td>
          <td>{{ optional($d->allhoactivities->fromcity)->name }}</td>
          <td>{{ optional($d->allhoactivities->tocity)->name }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->