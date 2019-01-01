@section('title', 'Data Alat Karyawan')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th colspan="14"><h2>Data Alat Karyawan</h2></th>
          <th style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
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
          <th>NIK KARYAWAN</th>
          <th>KARYAWAN</th>
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
          <td>{{ $d->tools->code }}</td>
          <td>{{ $d->tools->item }}</td>
          <td>{{ $d->tools->merk }}</td>
          <td>{{ $d->tools->type }}</td>
          <td>{{ $d->tools->serial_number }}</td>
          <td>{{ $d->tools->imei }}</td>
          <td>{{ $d->handover->toarea->name }}</td>
          <td>{{ $d->karyawan->assignmentarea->name }}</td>
          <td>{{ $d->handover->project->name }}</td>
          <td>{{ $d->karyawan->id_karyawan }}</td>
          <td>{{ $d->karyawan->name }}</td>
          <td>{{ $d->karyawan->position->name }}</td>
          <td>{{ HelpMe::tgl_sql_to_indo($d->renew_date) }}</td>
          <td>{{ optional($d->condition)->name }}</td>
          <!-- <td>{{ HelpMe::tgl_sql_to_indo($d->tools->date) }}</td>
          <td>{{ HelpMe::cost($d->tools->price) }}</td> -->
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
