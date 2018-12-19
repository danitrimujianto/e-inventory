@extends('layouts.app')
@section('title', $theme['modulName'])
@section('content')
<!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        {{ $theme['modulName'] }}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @if(isset($alert))<?php echo $alert; ?>@endif
        @include('moduls.'.$theme['modul'].'.'.$theme['page'], ['data' => $data])
    </section>
    <!-- /.content -->
@endsection

@section('footerAdd')
<input type="hidden" id="modulPage" value="{{ $theme['modul'] }}">
@endsection
