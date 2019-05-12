<?php $usertype = Auth::user()->usertype_id; ?>
<div class="row">
<div class="col-md-12">
<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    <img class="profile-user-img img-responsive img-circle image" id="img-avatar" src="{{ HelpMe::cekImg($data->avatar) }}" alt="User profile picture" style=" width: 100px; height: 100px;">
    <h3 class="profile-username text-center">{{ $data->name }}</h3>

    <p class="text-muted text-center">{{ $data->userType }}</p>

    <ul class="list-group list-group-unbordered">
    <!-- <li class="list-group-item">
      <b>Nama</b> <a class="pull-right">{{ $data->name }}</a>
    </li> -->
    @if($usertype == 1)
      <li class="list-group-item">
        <b><i class="fa fa-user margin-r-5"></i> Name</b> <a class="pull-right">{{ $data->name }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-envelope-o margin-r-5"></i> Email</b> <a class="pull-right">{{ $data->email }}</a>
      </li>
    @else
      <li class="list-group-item">
        <b><i class="fa fa-puzzle-piece margin-r-5"></i> Departemen</b> <a class="pull-right">{{ optional($data->karyawan->departemen)->name }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-tag margin-r-5"></i> Position</b> <a class="pull-right">{{ optional($data->karyawan->position)->position }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-tasks margin-r-5"></i> Project</b> <a class="pull-right">{{ optional($data->karyawan->project)->name }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-map-pin margin-r-5"></i> Homebase Area</b> <a class="pull-right">{{ optional($data->karyawan->homebasearea)->name }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-map-pin margin-r-5"></i> Assignment Area</b> <a class="pull-right">{{ optional($data->karyawan->assignmentarea)->name }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-mobile margin-r-5"></i> Phone Number</b> <a class="pull-right">{{ $data->karyawan->phone_number }}</a>
      </li>
      <li class="list-group-item">
        <b><i class="fa fa-envelope-o margin-r-5"></i> Email</b> <a class="pull-right">{{ $data->email }}</a>
      </li>
    @endif
    </ul>
    <a href="/profile/edit/{{ $data->id }}" class="btn btn-success btn-block"><b><i class="fa fa-edit"></i> Edit</b></a>
  </div>
  <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->

</div>
<!-- /.row -->
