 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/adminlte/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Project KP</span>
    </a>
 <!-- Sidebar -->
 <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->nama_user}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
    
          <li class="nav-header">MENU</li>
          @if (auth()->guard('admin')->user()->id_jabatan == '1')
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Periode
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/periode" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Periode Stok</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/periode/tutupperiode" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tutup Periode</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/periode/bukaperiode" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Buka Periode</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          <li class="nav-item">
            <a href="/saldoawal" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                Saldo Awal
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/penerimaan" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Penerimaan
              </p>
            </a>
          </li>

          <!--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Penerimaan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Non Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hibah Non Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hibah Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Non APBD</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="/penggunaan" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Penggunaan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pengeluaran" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Pengeluaran
              </p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="/opname" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Opname
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pemusnahan" class="nav-link">
              <i class="nav-icon fas fa-fire"></i>
              <p>
                Pemusnahan
              </p>
            </a>
          </li>
          <li class="nav-header">SIMDA</li>
          <li class="nav-item">
            <a href="/buktiumum" class="nav-link">
              <i class="nav-icon fas fa-file-alt "></i>
              <p>
                Bukti Umum
              </p>
            </a>
          </li>-->
          <li class="nav-header">Admin</li>
          <li class="nav-item">
            <a href="/tambah-user" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Tambah User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/barang" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Master Barang
              </p>
            </a>
          </li>
          <li class="nav-header">PELAPORAN</li>
          <li class="nav-item">
            <a href="/laporan" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-header">USER</li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>