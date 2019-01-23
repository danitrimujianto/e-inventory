@section('title', 'Report Employee Tools')
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
          <th>ID TOOLS</th>
          <th>ITEM</th>
          <th>MERK</th>
          <th>TYPE</th>
          <th>SN</th>
          <th>IMEI</th>
          <th>AREA</th>
          <th>CITY</th>
          <th>PROJECT</th>
          <th>ID EMPLOYEE</th>
          <th>EMPLOYEE</th>
          <th>POSITION</th>
          <th>UPDATE DATE</th>
          <th>CONDITION</th>
          <!-- <th>PURCHASE</th> -->
          <!-- <th>PRICE</th> -->
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
          <td>{{ optional($d->tools)->merk }}</td>
          <td>{{ optional($d->tools)->type }}</td>
          <td>{{ optional($d->tools)->serial_number }}</td>
          <td>{{ optional($d->tools)->imei }}</td>
          <td>{{ optional($d->handover->toarea)->name }}</td>
          <td>{{ optional($d->karyawan->assignmentarea)->name }}</td>
          <td>{{ optional($d->handover->project)->name }}</td>
          <td>{{ optional($d->karyawan)->id_karyawan }}</td>
          <td>{{ optional($d->karyawan)->name }}</td>
          <td>{{ optional($d->karyawan->position)->name }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->renew_date) }}</td>
          <td>{{ optional($d->condition)->name }}</td>
          <!-- <td>{{ HelpMe::tgl_sql_to_indo($d->tools->date) }}</td>
          <td>{{ HelpMe::cost($d->tools->price) }}</td> -->
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
