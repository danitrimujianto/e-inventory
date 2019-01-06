<?php
$usertype = Auth::user()->usertype_id;
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="/">
          <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
      </li>
      @if($usertype == 1)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/area"><i class="fa fa-ellipsis-v"></i> Area</a></li>
          <li><a href="/city"><i class="fa fa-ellipsis-v"></i> City</a></li>
          <li><a href="/departemen"><i class="fa fa-ellipsis-v"></i> Departemen</a></li>
          <li><a href="/position"><i class="fa fa-ellipsis-v"></i> Position</a></li>
          <li><a href="/supplier"><i class="fa fa-ellipsis-v"></i> Supplier</a></li>
          <li><a href="/vendor"><i class="fa fa-ellipsis-v"></i> Vendor</a></li>
          <li><a href="/delivery"><i class="fa fa-ellipsis-v"></i> Delivery</a></li>
          <li><a href="/division"><i class="fa fa-ellipsis-v"></i> Division</a></li>
          <li><a href="/goodscondition"><i class="fa fa-ellipsis-v"></i> Condition</a></li>
          <li><a href="/barang"><i class="fa fa-ellipsis-v"></i> Goods</a></li>
          <li><a href="/tools"><i class="fa fa-ellipsis-v"></i> Tools</a></li>
          <li><a href="/warehouse"><i class="fa fa-ellipsis-v"></i> Warehouse</a></li>
          <li><a href="/project"><i class="fa fa-ellipsis-v"></i> Projects</a></li>
          <li><a href="/karyawan"><i class="fa fa-ellipsis-v"></i> Employee</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> All HO Activities</a></li>
          <li><a href="/handover"><i class="fa fa-ellipsis-v"></i> Handover Submission</a></li>
          <li><a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Handover Acceptance</a></li>
        </ul>
      </li>
      <li>
        <a href="/alatkaryawan">
          <i class="fa fa-th"></i> <span>Employee Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/requesttools">
          <i class="fa fa-th"></i> <span>Request Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/service">
          <i class="fa fa-th"></i> <span>Service</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Report</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/rep/mutasi"><i class="fa fa-ellipsis-v"></i> Mutasi Tools Karyawan</a></li>
          <li><a href="/rep/newtools"><i class="fa fa-ellipsis-v"></i> Pengajuan Tools Baru</a></li>
          <li><a href="/rep/alatkaryawan"><i class="fa fa-ellipsis-v"></i> Data Alat Karyawan</a></li>
          <li><a href="/rep/service"><i class="fa fa-ellipsis-v"></i> Service</a></li>
          <li><a href="/rep/stoktools"><i class="fa fa-ellipsis-v"></i> Stok Tools</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-gear"></i>
          <span>Setting</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/user"><i class="fa fa-ellipsis-v"></i> User</a></li>
          <li><a href="/tipeuser"><i class="fa fa-ellipsis-v"></i> Tipe User</a></li>
        </ul>
      </li>
      <!-- Menu General Admin -->
      @elseif($usertype == 2)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> All HO Activities</a></li>
          <li><a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Handover Acceptance</a></li>
        </ul>
      </li>
      <li>
        <a href="/alatkaryawan">
          <i class="fa fa-th"></i> <span>Employee Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/requesttools">
          <i class="fa fa-th"></i> <span>Request Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/service">
          <i class="fa fa-th"></i> <span>Service</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Report</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/rep/mutasi"><i class="fa fa-ellipsis-v"></i> Mutasi Tools Karyawan</a></li>
          <li><a href="/rep/newtools"><i class="fa fa-ellipsis-v"></i> Pengajuan Tools Baru</a></li>
          <li><a href="/rep/alatkaryawan"><i class="fa fa-ellipsis-v"></i> Data Alat Karyawan</a></li>
          <li><a href="/rep/service"><i class="fa fa-ellipsis-v"></i> Service</a></li>
          <li><a href="/rep/stoktools"><i class="fa fa-ellipsis-v"></i> Stok Tools</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-gear"></i>
          <span>Setting</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/user"><i class="fa fa-ellipsis-v"></i> User</a></li>
        </ul>
      </li>
      <!-- Menu Manager -->
      @elseif($usertype == 3)
      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Handover Acceptance</a></li>
        </ul>
      </li> -->
      <li>
        <a href="/alatkaryawan">
          <i class="fa fa-th"></i> <span>Employee Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/requesttools">
          <i class="fa fa-th"></i> <span>Request Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <!-- Menu User -->
      @elseif($usertype == 4)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> All HO Activities</a></li> -->
          <li><a href="/handover"><i class="fa fa-ellipsis-v"></i> Handover Submission</a></li>
          <li><a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Handover Acceptance</a></li>
        </ul>
      </li>
      <li>
        <a href="/alatkaryawan">
          <i class="fa fa-th"></i> <span>Employee Tools</span>
        </a>
      </li>
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
