<div class="sidebar">
    <div class="sidebar-header">

        <a href="{{ route('sileg.index') }}" class="sidebar-logo"  style="">SILEG</a>

    </div>
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Beranda</a>
            <ul class="nav nav-sidebar">

                <li class="nav-item">
                    <a href="{{ route('sileg.index') }}" class="nav-link {{ request()->routeIs('sileg.index') ? ' active' : '' }}">
                        <i class="ri-pie-chart-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>



            </ul>
        </div>
        <div class="nav-group show">
            <a href="#" class="nav-label">Data Pengusul</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('komisi.index') }}" class="nav-link {{ request()->routeIs('komisi*') ? ' active' : '' }}"><i
                            class="ri-file-text-line"></i> <span>Daftar DPR (Komisi)</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fraksi.index') }}" class="nav-link {{ request()->routeIs('fraksi*') ? ' active' : '' }}"><i
                            class="ri-file-text-line"></i> <span>Daftar DPR (Fraksi)</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('masyarakat.index') }}" class="nav-link {{ request()->routeIs('masyarakat*') ? ' active' : '' }}">
                        <i class="ri-file-text-line"></i> <span>Daftar DPR (Masyarakat)</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pemerintah.index') }}"
                        class="nav-link {{ request()->routeIs('pemerintah*') ? 'active' : '' }}">
                        <i class="ri-file-text-line"></i> <span>Daftar Pemerintah</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dpd.index') }}" class="nav-link {{ request()->routeIs('dpd*') ? ' active' : '' }}"><i
                            class="ri-file-text-line"></i> <span>Daftar DPD</span></a>
                </li>


            </ul>
        </div>

        <div class="nav-group show">
            <a href="#" class="nav-label">Data Referensi</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('pembahasan_ruu.index') }}"
                        class="nav-link {{ request()->routeIs('pembahasan_ruu*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar Pembahasan RUU</span></a>
                </li>
            </ul>
        </div>

        <div class="nav-group show">
            <a href="#" class="nav-label">Data Transaksi</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('ruu.index') }}"
                    class="nav-link {{ request()->routeIs('ruu.index*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar RUU</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kumulatif.index') }}"
                        class="nav-link {{ request()->routeIs('kumulatif*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar Kumulatif</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ruu_riwayat.index') }}"
                        class="nav-link {{ request()->routeIs('ruu_riwayat*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar Riwayat RUU Prioritas</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ruu_longlist.index') }}"
                        class="nav-link {{ request()->routeIs('ruu_longlist*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar Riwayat RUU Longlist</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('feedback.index') }}"
                        class="nav-link {{ request()->routeIs('feedback*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar Feedback</span></a>
                </li>
            </ul>
        </div>

        <div class="nav-group show">
            <a href="#" class="nav-label">Data Laporan</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('statistik.index') }}" class="nav-link {{ request()->routeIs('statistik*') ? ' active' : '' }}"><i
                            class="ri-newspaper-line"></i> <span>Daftar Statistik</span></a>
                </li>
            </ul>
        </div>

    </div>

    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
            <div class="sidebar-footer-thumb">
                @if (session('informal_photo_name'))
                    <img src="https://berkas.dpr.go.id/portal/photos/{{ session('informal_photo_name') }}"
                        alt="Foto Profil">
                @else
                    <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user.png') }}" alt="Foto Profil">
                @endif
            </div>
            <div class="sidebar-footer-body">
                <h6><a href="#">{{ session('nama') }}</a></h6>
                <p>admin</p>
            </div>
            <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
        </div>
        <div class="sidebar-footer-menu">
            <nav class="nav">
                {{-- <a href="{{ route('profil.edit', 0) }}"><i class="ri-edit-2-line"></i> Sunting Profil</a>
                <a href="{{ route('profil.index') }}"><i class="ri-profile-line"></i> Tampilkan Profil</a> --}}
            </nav>
            <hr>
            <nav class="nav">
                <a href="#"><i class="ri-question-line"></i> Pusat Bantuan</a>
                <a href="#"><i class="ri-lock-line"></i> Pengaturan Privasi</a>
                <a href="#"><i class="ri-user-settings-line"></i> Pengaturan Akun</a>
                {{-- <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-r-line"></i> Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> --}}
            </nav>
        </div>
    </div>
</div>
