<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/images/logo_smktia.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info" style="padding: 15px;">
          <p>SMK TI AIRLANGGA</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li>
            <a href="{{ route('home') }}">
              <i class="fa fa-th"></i> <span>Dashboard</span>
            </a>
          </li>

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Data Pendaftar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('index.pendaftar') }}"><i class="fa fa-circle-o"></i>Pendaftar Awal</a></li>
            <li><a href="{{ route('index.daftar') }}"><i class="fa fa-circle-o"></i>Pendaftar Ulang</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-user"></i> <span>Pengguna</span>
          </a>
        </li> 
        <li>
            <a href="#">
              <i class="fa fa-files-o"></i> <span>Laporan</span>
            </a>
        </li>       
    </section>
    <!-- /.sidebar -->
</aside>