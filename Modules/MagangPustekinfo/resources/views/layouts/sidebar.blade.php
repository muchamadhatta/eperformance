<div class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('magangpustekinfo.admin.dashboard.index') }}" class="sidebar-logo"><h6>PUSTEKINFO INTERNSHIP</h6></a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Dashboard</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('magangpustekinfo.admin.dashboard.index') }}" class="nav-link {{ request()->routeIs('magangpustekinfo.admin.dashboard.index') ? 'active' : '' }}"><i
                            class="ri-pie-chart-2-line"></i> <span>Dashboard Utama</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
        
        <div class="nav-group show mb-3">
            <a href="#" class="nav-label">Data Magang</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item {{ request()->routeIs('magangpustekinfo.admin.peserta_magang.*') ? 'active' : '' }}">
                    <a href="" class="nav-link has-sub {{ request()->routeIs('magangpustekinfo.admin.peserta_magang.*') ? 'active show' : '' }}"><i class="ri-user-star-line"></i> <span>Data Magang</span></a>
                    <nav class="nav nav-sub {{ request()->routeIs('magangpustekinfo.admin.peserta_magang.*') ? 'active show' : '' }}">
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index') }}" class="nav-sub-link {{ request()->routeIs('magangpustekinfo.admin.peserta_magang.index') && !request()->query('status') && !request()->query('jenis_magang') ? 'active' : '' }}">Semua Peserta</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['jenis_magang' => 'Hub']) }}" class="nav-sub-link {{ request()->query('jenis_magang') == 'Hub' ? 'active' : '' }}">Magang Hub</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['jenis_magang' => 'Mandiri']) }}" class="nav-sub-link {{ request()->query('jenis_magang') == 'Mandiri' ? 'active' : '' }}">Magang Mandiri</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Permohonan']) }}" class="nav-sub-link {{ request()->query('status') == 'Permohonan' ? 'active' : '' }}">Permohonan</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Belum Dimulai']) }}" class="nav-sub-link {{ request()->query('status') == 'Belum Dimulai' ? 'active' : '' }}">Belum Mulai</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Dalam Proses']) }}" class="nav-sub-link {{ request()->query('status') == 'Dalam Proses' ? 'active' : '' }}">Sedang Berjalan</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.index', ['status' => 'Selesai']) }}" class="nav-sub-link {{ request()->query('status') == 'Selesai' ? 'active' : '' }}">Sudah Selesai</a>
                        <a href="{{ route('magangpustekinfo.admin.peserta_magang.create') }}" class="nav-sub-link {{ request()->routeIs('magangpustekinfo.admin.peserta_magang.create') ? 'active' : '' }}">Tambah Peserta Magang</a>
                    </nav>
                </li>
                <li class="nav-item {{ request()->routeIs('magangpustekinfo.admin.universitas.*') || request()->routeIs('magangpustekinfo.admin.universitas_custom.*') ? 'active' : '' }}">
                    <a href="" class="nav-link has-sub {{ request()->routeIs('magangpustekinfo.admin.universitas.*') || request()->routeIs('magangpustekinfo.admin.universitas_custom.*') ? 'active show' : '' }}"><i class="ri-building-2-line"></i> <span>Data Universitas</span></a>
                    <nav class="nav nav-sub {{ request()->routeIs('magangpustekinfo.admin.universitas.*') || request()->routeIs('magangpustekinfo.admin.universitas_custom.*') ? 'active show' : '' }}">
                        <a href="{{ route('magangpustekinfo.admin.universitas.index') }}" class="nav-sub-link {{ request()->routeIs('magangpustekinfo.admin.universitas.index') ? 'active' : '' }}">Daftar Universitas</a>
                        <a href="{{ route('magangpustekinfo.admin.universitas_custom.index') }}" class="nav-sub-link {{ request()->routeIs('magangpustekinfo.admin.universitas_custom.*') ? 'active' : '' }}">Universitas Custom</a>
                    </nav>
                </li>
                <li class="nav-item {{ request()->routeIs('magangpustekinfo.admin.sekolah.*') || request()->routeIs('magangpustekinfo.admin.sekolah_custom.*') ? 'active' : '' }}">
                    <a href="" class="nav-link has-sub {{ request()->routeIs('magangpustekinfo.admin.sekolah.*') || request()->routeIs('magangpustekinfo.admin.sekolah_custom.*') ? 'active show' : '' }}"><i class="ri-community-line"></i> <span>Data Sekolah</span></a>
                    <nav class="nav nav-sub {{ request()->routeIs('magangpustekinfo.admin.sekolah.*') || request()->routeIs('magangpustekinfo.admin.sekolah_custom.*') ? 'active show' : '' }}">
                        <a href="{{ route('magangpustekinfo.admin.sekolah.index') }}" class="nav-sub-link {{ request()->routeIs('magangpustekinfo.admin.sekolah.index') ? 'active' : '' }}">Daftar Sekolah</a>
                        <a href="{{ route('magangpustekinfo.admin.sekolah_custom.index') }}" class="nav-sub-link {{ request()->routeIs('magangpustekinfo.admin.sekolah_custom.*') ? 'active' : '' }}">Sekolah Custom</a>
                    </nav>
                </li>
                <li class="nav-item {{ request()->routeIs('magangpustekinfo.admin.jurusan.*') ? 'active' : '' }}">
                    <a href="{{ route('magangpustekinfo.admin.jurusan.index') }}" class="nav-link {{ request()->routeIs('magangpustekinfo.admin.jurusan.*') ? 'active' : '' }}"><i class="ri-book-open-line"></i> <span>Jurusan</span></a>
                </li>
                <li class="nav-item {{ request()->routeIs('magangpustekinfo.admin.kategori_project.*') ? 'active' : '' }}">
                    <a href="{{ route('magangpustekinfo.admin.kategori_project.index') }}" class="nav-link {{ request()->routeIs('magangpustekinfo.admin.kategori_project.*') ? 'active' : '' }}"><i class="ri-folder-open-line"></i> <span>Kategori Project</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
    </div><!-- sidebar-body -->
    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
            <div class="sidebar-footer-thumb">
                <img src="{{ asset('template/dist/assets/img/img1.jpg') }}" alt="">
            </div><!-- sidebar-footer-thumb -->
            <div class="sidebar-footer-body">
                <h6><a href="#">Admin</a></h6>
                <p>Administrator</p>
            </div><!-- sidebar-footer-body -->
            <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
        </div><!-- sidebar-footer-top -->
        <div class="sidebar-footer-menu">
            <nav class="nav">
                <a href="{{ route('magangpustekinfo.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-r-line"></i> Keluar
                </a>

                <form id="logout-form" action="{{ route('magangpustekinfo.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div><!-- sidebar-footer-menu -->
    </div><!-- sidebar-footer -->
</div><!-- sidebar -->