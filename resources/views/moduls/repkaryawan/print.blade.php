@section('title', 'Report Employee')
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12">
      <table style=" width: 100%; ">
        <tr>
          <th colspan="3" align="center"><h3 class="headerReport">@yield('title')</h3></th>
        </tr>
        <tr>
          <th colspan="3">@if(!empty($sq)) Filter by {{ $sf.' : '.$sq }} @else &nbsp; @endif</th>
          <th colspan="3" style=" text-align:right;">Print date: {{ date('d/m/Y') }}</th>
        </tr>
      </table>
      <table class="table table-striped" style=" width: 100%; ">
        <thead>
        <tr style="">
          <th>No.</th>
          <th>ID Employee</th>
          <th>Name</th>
          <th>Departemen</th>
          <th>Position</th>
          <th>Project</th>
          <!-- <th>Home Area</th> -->
          <th>Assignment Area</th>
          <th>Phone</th>
          <!-- <th>Email</th> -->
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @php $no = 0; @endphp
        @foreach($data AS $d)
        @php $no++; @endphp
        <tr>
          <td>{{ $no.'.' }}</td>
          <td>{{ $d->id_karyawan }}</td>
          <td>{{ $d->name }}</td>
          <td>{{ optional($d->departemen)->name }}</td>
          <td>{{ optional($d->position)->position }}</td>
          <td>{{ optional($d->project)->name }}</td>
          <!-- <td>{{ optional($d->homebasearea)->name }}</td> -->
          <td>{{ optional($d->assignmentarea)->name }}</td>
          <td>{{ $d->phone_number }}</td>
          <!-- <td>{{ $d->email }}</td> -->
          <td><small class="label {{ HelpMe::bgStatus($d->status) }}">{{ $d->status }}</small></td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
