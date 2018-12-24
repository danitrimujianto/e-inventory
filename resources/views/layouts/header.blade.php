
<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">

    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{ asset('/dist/img/inventory-icon-white.png') }}" style=" width: 30px; height: 30px;"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      <img src="{{ asset('/dist/img/inventory-icon-white.png') }}" style=" width: 30px; height: 30px;">&nbsp;&nbsp;<b>e - INVENTORY</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs">{{ ucwords(Auth::user()->name) }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <!-- <img src="" class="img-circle" alt="User Image"> -->
              <p>
                {{ ucwords(Auth::user()->name) }}
              </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/profile" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-default btn-flat" id="logout">Log out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
