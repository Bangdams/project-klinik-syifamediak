<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Klinik Syifa Medika</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  {{-- JQuery Hide --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
      {{-- Yield Buat Cari --}}
        @if ($cek == false)
          <form action="#" method="post" po class="form-inline mr-auto">
            @csrf
            <ul class="navbar-nav mr-3">
              <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
              <li><a href="#" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
            </ul>
            <div class="search-element">
                <input class="form-control" name="cari" type="text" readonly placeholder="Klinik Syifa Medika" aria-label="Search" data-width="250">

                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        @else
           @yield('cari')
        @endif

        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                  <a href="#" class="dropdown-item">
                    <div class="dropdown-item-icon bg-info text-white">
                      <i class="far fa-user"></i>
                    </div>
                    <div class="dropdown-item-desc">
                      <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                      <div class="time">10 Hours Ago</div>
                    </div>
                  </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ url('') }}/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">{{ Auth::user()->name }}</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ url('dashboard') }}">Klinik Syifa Medika</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('dashboard') }}">KSM</a>
          </div>
          <ul class="sidebar-menu">
              
              @if (Auth::user()->level == "admin")

              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown" id="dashboard">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('dashboard') }}">Menu Utama</a></li>
                  <li><a class="nav-link" href="{{ route('dataUsers.index') }}">Data User</a></li>
                  <li><a class="nav-link" href="{{ route('diagnosa.index') }}">Data Diagnosa</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown" id="data-obat">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-prescription-bottle-alt"></i> <span>Data Obat</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('obat.index') }}">Data Obat</a></li>
                  <li><a class="nav-link" href="{{ route('rekapObat.index') }}">Rekap Obat Harian</a></li>
                </ul>
              </li>
              
              <li class="nav-item dropdown" id="pendaftaran">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-clipboard"></i> <span>Pendaftaran</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('pendaftaran.index') }}">Daftar</a></li>
                  <li><a class="nav-link" href="{{ route('dataPasien.index') }}">Data Pasien</a></li>
                </ul>
              </li>
              
              <li class="nav-item dropdown" id="resep">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Pemeriksaan Harian</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('riwayatPemeriksaan') }}">Pemeriksaan Harian</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown" id="laporan">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('rekapObats.index') }}">Rekap Obat</a></li>
                  <li><a class="nav-link" href="{{ url('dataPemeriksaan') }}">Laporan Pemeriksaan</a></li>
                </ul>
              </li>
              @endif

              @if (Auth::user()->level == "dokter")

              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown" id="dashboard">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('dashboard') }}">Menu Utama</a></li>

                </ul>
              </li>

              <li class="nav-item dropdown" id="pemeriksaan">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Pemeriksaan</span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('pemeriksaan.index') }}">Daftar Pasien</a></li>
                  <li><a href="{{ route('rekamMedis.index') }}">Rekam Medis</a></li>
                  {{-- <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li> --}}
                </ul>
              </li>
              @endif

              @if (Auth::user()->level == 'apoteker')

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown" id="dashboard">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('dashboard') }}">Menu Utama</a></li>
                    <li><a href="{{ route('obat.index') }}">Obat</a></li>
                    <li><a href="{{ route('resepObat.index') }}">Resep</a></li>
                    <li><a class="nav-link" href="{{ route('rekapObats.index') }}">Rekap Obat</a></li>
                  </ul>
                </li>

              @endif
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('body')
        </section>
        
        {{-- Modal --}}
        {{-- @yield('modal') --}}
        {{-- @include('layout.pages.modal.modalRekamMedis') --}}
        <div class="modal fade" tabindex="-1" role="dialog" id="cek">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Rekam Medis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nomer Pemeriksaan</label>
                    <input type="text" placeholder="Masukan Nama Obat" id="no_pemeriksaan" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" placeholder="Masukan Jenis Obat" id="nama" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Keluhan</label>
                    <input type="text" placeholder="Masukan Nominal" id="keluhan" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="text" placeholder="Masukan Nominal" id="diagnosa" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Therapy</label>
                    <input type="text" placeholder="Tidak Melakukan Therapy" id="terapi" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" placeholder="Masukan Stok" id="tanggal" class="form-control" readonly>
                  </div>
               </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2022 <div class="bullet"></div> Design By <a href="https://nauval.in/">Sadam</a>
        </div>
        <div class="footer-right">
          1.0.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{url('')}}/assets/js/stisla.js"></script>
  {{-- Jquery --}}



  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{url('')}}/assets/js/scripts.js"></script>
  <script src="{{url('')}}/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>