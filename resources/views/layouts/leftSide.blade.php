<?php
$usertype = Auth::user()->usertype_id;
$handover = "0";
$warehouse = "0";
$submission = "0";
$acceptance = "0";
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
          <li><a href="/departemen"><i class="fa fa-ellipsis-v"></i> Department</a></li>
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
          <li><a href="/emailexternal"><i class="fa fa-ellipsis-v"></i> Email External</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <small class="label bg-red">{{ $handover }}</small>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> Handover Warehouse
              <small class="label pull-right bg-red">{{ $warehouse }}</small>
            </a>
          </li>
          <li>
            <a href="/handover"><i class="fa fa-ellipsis-v"></i> Handover Submission
            </a>
          </li>
          <li>
            <a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Handover Acceptance
            </a>
          </li>
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
          <i class="fa fa-th"></i> <span>Request New Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/service">
          <i class="fa fa-th"></i> <span>Maintenance</span>
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
          <li><a href="/rephandover"><i class="fa fa-ellipsis-v"></i> Handover</a></li>
          <li><a href="/repretur"><i class="fa fa-ellipsis-v"></i> Retur</a></li>
          <li><a href="/repreqtools"><i class="fa fa-ellipsis-v"></i> Request New Tools</a></li>
          <li><a href="/repemployeetools"><i class="fa fa-ellipsis-v"></i> Employee Tools</a></li>
          <li><a href="/repservice"><i class="fa fa-ellipsis-v"></i> Maintenance</a></li>
          <li><a href="/reptools"><i class="fa fa-ellipsis-v"></i> Tool</a></li>
          <li><a href="/repstoktools"><i class="fa fa-ellipsis-v"></i> Stock Tools</a></li>
          <li><a href="/repkaryawan"><i class="fa fa-ellipsis-v"></i> Employee</a></li>
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
          <span>Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="/supplier"><i class="fa fa-ellipsis-v"></i> Supplier</a></li>
          <li><a href="/barang"><i class="fa fa-ellipsis-v"></i> Goods</a></li>
          <li><a href="/tools"><i class="fa fa-ellipsis-v"></i> Tools</a></li>
          <li><a href="/project"><i class="fa fa-ellipsis-v"></i> Projects</a></li>
          <li><a href="/karyawan"><i class="fa fa-ellipsis-v"></i> Employee</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <small class="label bg-red">{{ $handover }}</small>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> Warehouse
              <small class="label pull-right bg-red">{{ $warehouse }}</small>
            </a>
          </li>
          <li>
            <a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Acceptance
              <small class="label pull-right bg-red">{{ $acceptance }}</small>
            </a>
          </li>
          <li>
            <a href="/horetur"><i class="fa fa-ellipsis-v"></i> Retur Tools
              <small class="label pull-right bg-red">{{ $retur }}</small>
            </a>
          </li>
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
          <i class="fa fa-th"></i> <span>Request New Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/service">
          <i class="fa fa-th"></i> <span>Maintenance</span>
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
          <li><a href="/rephandover"><i class="fa fa-ellipsis-v"></i> Handover</a></li>
          <li><a href="/repretur"><i class="fa fa-ellipsis-v"></i> Retur</a></li>
          <li><a href="/repreqtools"><i class="fa fa-ellipsis-v"></i> Request New Tools</a></li>
          <li><a href="/repemployeetools"><i class="fa fa-ellipsis-v"></i> Employee Tools</a></li>
          <li><a href="/repservice"><i class="fa fa-ellipsis-v"></i> Maintenance</a></li>
          <li><a href="/reptools"><i class="fa fa-ellipsis-v"></i> Tool</a></li>
          <li><a href="/repstoktools"><i class="fa fa-ellipsis-v"></i> Stock Tools</a></li>
          <li><a href="/repkaryawan"><i class="fa fa-ellipsis-v"></i> Employee</a></li>
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
          <i class="fa fa-th"></i> <span>Request New Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      <li>
        <a href="/service">
          <i class="fa fa-th"></i> <span>Maintenance</span>
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
          <li><a href="/rephandover"><i class="fa fa-ellipsis-v"></i> Handover</a></li>
          <li><a href="/repretur"><i class="fa fa-ellipsis-v"></i> Retur</a></li>
          <li><a href="/repreqtools"><i class="fa fa-ellipsis-v"></i> Request New Tools</a></li>
          <li><a href="/repemployeetools"><i class="fa fa-ellipsis-v"></i> Employee Tools</a></li>
          <li><a href="/repservice"><i class="fa fa-ellipsis-v"></i> Maintenance</a></li>
          <li><a href="/reptools"><i class="fa fa-ellipsis-v"></i> Tool</a></li>
          <li><a href="/repstoktools"><i class="fa fa-ellipsis-v"></i> Stock Tools</a></li>
          <li><a href="/repkaryawan"><i class="fa fa-ellipsis-v"></i> Employee</a></li>
        </ul>
      </li>
      <!-- Menu User -->
      @elseif($usertype == 4)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <small class="label bg-red">{{ $handover }}</small>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> All HO Activities</a></li> -->
          <li>
            <a href="/handover"><i class="fa fa-ellipsis-v"></i> Submission
              <small class="label pull-right bg-red">{{ $submission }}</small>
            </a>
          </li>
          <li>
            <a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Acceptance
              <small class="label pull-right bg-red">{{ $acceptance }}</small>
            </a>
          </li>
          <li>
            <a href="/horetur"><i class="fa fa-ellipsis-v"></i> Retur Tools
              <small class="label pull-right bg-red">{{ $retur }}</small>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <a href="/alatkaryawan">
          <i class="fa fa-th"></i> <span>Employee Tools</span>
        </a>
      </li>
      @if(Auth::user()->request_tools == 1)
      <li>
        <a href="/requesttools">
          <i class="fa fa-th"></i> <span>Request New Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      @endif
      @elseif($usertype == 5)
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Handover</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="/allhoactivities"><i class="fa fa-ellipsis-v"></i> All HO Activities</a></li> -->
          <li><a href="/handover"><i class="fa fa-ellipsis-v"></i> Submission</a></li>
          <li><a href="/hoaccept"><i class="fa fa-ellipsis-v"></i> Acceptance</a></li>
          <li><a href="/horetur"><i class="fa fa-ellipsis-v"></i> Retur Tools</a></li>
        </ul>
      </li>
      <li>
        <a href="/alatkaryawan">
          <i class="fa fa-th"></i> <span>Employee Tools</span>
        </a>
      </li>
      <li>
        <a href="/otheremployeetools">
          <i class="fa fa-th"></i> <span>Other Employee Tools</span>
        </a>
      </li>
      <li>
        <a href="/requesttools">
          <i class="fa fa-th"></i> <span>Request New Tools</span>
          <!-- <small class="label pull-right bg-green">new</small> -->
        </a>
      </li>
      @elseif($usertype == 6)
      <li>
        <a href="/requesttools">
          <i class="fa fa-th"></i> <span>Request New Tools</span>
        </a>
      </li>
      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
