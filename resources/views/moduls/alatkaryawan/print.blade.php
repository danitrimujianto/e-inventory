@section('title', 'Data Alat Karyawan')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th colspan="13"><h2>Data Alat Karyawan</h2></th>
          <th colspan="2" style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
        <tr style="">
          <th>NO.</th>
          <th>ID TOOLS</th>
          <th>ITEM</th>
          <th>MERK</th>
          <th>TYPE</th>
          <th>SN</th>
          <th>IMEI</th>
          <th>PROJECT</th>
          <th>ID EMPLOYEE</th>
          <th>EMPLOYEE</th>
          <th>HOMEBASE</th>
          <th>ASSIGNMENT</th>
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
          <td>{{ optional($d->handover->project)->name }}</td>
          <td>{{ optional($d->karyawan)->id_karyawan }}</td>
          <td>{{ optional($d->karyawan)->name }}</td>
          <td>{{ optional($d->handover->toarea)->name }}</td>
          <td>{{ optional($d->karyawan->assignmentarea)->name }}</td>
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
