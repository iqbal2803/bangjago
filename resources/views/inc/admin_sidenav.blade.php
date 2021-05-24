<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/logo_bangjago.jpg')}}" alt="BangJago Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Bang Jago</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(in_array('1', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Daftar Pelanggan
                <i class="right fas fa-angle-right" ></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('daftar_pelanggan.daftar_bank')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Bank</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('daftar_pelanggan.daftar_tagihan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Tagihan</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(in_array('2', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="{{route('bank.index')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pengaturan Bank
              </p>
            </a>
          </li>
          @endif
          @if(in_array('3', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="{{route('tagihan.index')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pengaturan Tagihan
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role->nama_role=='Admin Cabang' && in_array('4', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Riwayat Transaksi
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('transaksi/riwayat_transfer/'.Auth::user()->cabang->id)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('transaksi/riwayat_tarik_tunai/'.Auth::user()->cabang->id)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Tarik Tunai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('transaksi/riwayat_tagihan/'.Auth::user()->cabang->id)}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Riwayat Tagihan</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(in_array('5', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('laporan.transaksi_transfer')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('laporan.transaksi_tarik_tunai')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Tarik Tunai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('laporan.transaksi_tagihan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Tagihan</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(in_array('6', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="{{route('cabang.daftar_cabang')}}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Cabang
              </p>
            </a>
          </li>
          @endif
          @if(in_array('7', json_decode(Auth::user()->role->permission)))
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pengaturan Staff
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staff.daftar_staff')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('role.daftar_role')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hak Akses</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>