<div class="sidebar">
    <div class="sidebar-header">
        {{-- <a href="{{ route('setjenweb.index') }}" class="sidebar-logo">Unit Kerja Terkait</a> --}}
        <a href="{{ route('setjenweb.index') }}" class="sidebar-logo">SETJEN WEB</a>
        {{-- <a style=" padding: 5px; color: white; background: #506fd9;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #fdbb2d, #b21f1f, #506fd9);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #fdbb2d, #b21f1f, #506fd9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        "
            href="{{ route('setjenweb.index') }}" class="sidebar-logo">SETJEN WEB</a> --}}
    </div>
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Beranda</a>
            <ul class="nav nav-sidebar">

                <li class="nav-item">
                    <a href="{{ route('setjenweb.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.index') ? ' active' : '' }}">
                        <i class="ri-pie-chart-2-line"></i> <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-group show">
            <a href="#" class="nav-label">Data Referensi</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('setjenweb.menu.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.menu*') ? ' active' : '' }}"><i
                            class="ri-folder-2-line"></i> <span>Daftar Menu</span></a>
                </li>
                @if ($id_website != 3)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.tujuan_agenda.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.tujuan_agenda*') ? ' active' : '' }}"><i
                                class="ri-folder-2-line"></i> <span>Daftar Tujuan Agenda</span></a>
                    </li>
                @endif

                @if ($id_website != 14)
                <li class="nav-item">
                    <a href="{{ route('setjenweb.jenis_dokumen.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.jenis_dokumen*') ? ' active' : '' }}"><i
                            class="ri-folder-2-line"></i> <span>Daftar Jenis Dokumen</span></a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('setjenweb.pegawai.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.pegawai*') ? ' active' : '' }}"><i
                            class="ri-folder-2-line"></i> <span>Daftar Pegawai</span></a>
                </li>
                @if ($id_website == 13)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.pengajar.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.pengajar*') ? 'active' : '' }}">
                            <i class="ri-folder-2-line"></i> <span>Daftar Pengajar</span>
                        </a>
                    </li>
                @endif
                @if ($id_website == 2)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.provinsi.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.provinsi*') ? 'active' : '' }}">
                            <i class="ri-folder-2-line"></i> <span>Daftar Provinsi</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="nav-group show">
            <a href="#" class="nav-label">Data Website</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('setjenweb.website_menu.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.website_menu*') ? ' active' : '' }}"><i
                            class="ri-menu-add-fill"></i> <span>Daftar Menu Website</span></a>
                </li>
                @if ($id_website != 3)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.agenda.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.agenda*') ? ' active' : '' }}"><i
                                class="ri-calendar-event-line"></i> <span>Daftar Agenda</span></a>
                    </li>
                @endif
                @if ($id_website != 1)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.berita.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.berita*') ? ' active' : '' }}">
                            <i class="ri-newspaper-line"></i> <span>Daftar Berita</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('setjenweb.galeri.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.galeri*') ? 'active' : '' }}">
                        <i class="ri-image-2-line"></i> <span>Daftar Galeri</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setjenweb.billboard.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.billboard*') ? 'active' : '' }}">
                        <i class="ri-artboard-line"></i> <span>Daftar Billboard</span>
                    </a>
                </li>
                @if ($id_website != 14)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.publikasi.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.publikasi*') ? 'active' : '' }}">
                            <i class="ri-file-text-line"></i> <span>Daftar Publikasi</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('setjenweb.statik.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.statik*') ? 'active' : '' }}">
                        <i class="ri-flag-2-line"></i> <span>Daftar Statik</span>
                    </a>
                </li>
                @if ($id_website == 3)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.aduan_wbs.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.aduan_wbs*') ? 'active' : '' }}">
                            <i class="ri-question-answer-line"></i> <span>Daftar Aduan WBS</span>
                        </a>
                    </li>
                @endif
                @if ($id_website == 14)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.komentar.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.komentar*') ? 'active' : '' }}">
                            <i class="ri-question-answer-line"></i> <span>Komentar</span>
                        </a>
                    </li>
                @endif
                @if (
                    $id_website == 1 ||
                        $id_website == 13 ||
                        $id_website == 14 ||
                        $id_website == 3 ||
                        $id_website == 15 ||
                        $id_website == 10 ||
                        $id_website == 8 ||
                        $id_website == 11)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.layanan.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.layanan*') ? 'active' : '' }}">
                            <i class="ri-service-line"></i> <span>Layanan</span>
                        </a>
                    </li>
                @endif
                @if ($id_website == 2)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.mou.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.mou*') ? 'active' : '' }}">
                            <i class="ri-question-answer-line"></i> <span>Daftar MOU</span>
                        </a>
                    </li>
                @endif
                @if ($id_website == 2)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.output.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.output*') ? 'active' : '' }}">
                            <i class="ri-slideshow-line"></i> <span>Daftar Output</span>
                        </a>
                    </li>
                @endif
                @if ($id_website == 9)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.polls.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.polls*') ? 'active' : '' }}">
                            <i class="ri-thumb-up-line"></i> <span>Daftar Polls</span>
                        </a>
                    </li>
                @endif
                @if (
                    $id_website == 13 ||
                        $id_website == 14 ||
                        $id_website == 16 ||
                        $id_website == 17 ||
                        $id_website == 18 ||
                        $id_website == 19 ||
                        $id_website == 20 ||
                        $id_website == 21 ||
                        $id_website == 22 ||
                        $id_website == 23 ||
                        $id_website == 24 ||
                        $id_website == 25 ||
                        $id_website == 26 ||
                        $id_website == 27)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.sdm.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.sdm*') ? 'active' : '' }}">
                            <i class="ri-bar-chart-box-line"></i> <span>SDM</span>
                        </a>
                    </li>
                @endif
                @if (
                    $id_website == 1 ||
                        $id_website == 2 ||
                        $id_website == 3 ||
                        $id_website == 4 ||
                        $id_website == 5 ||
                        $id_website == 6 ||
                        $id_website == 7 ||
                        $id_website == 8 ||
                        $id_website == 9 ||
                        $id_website == 10 ||
                        $id_website == 11 ||
                        $id_website == 13 ||
                        $id_website == 14 ||
                        $id_website == 16 ||
                        $id_website == 17 ||
                        $id_website == 18 ||
                        $id_website == 19 ||
                        $id_website == 20 ||
                        $id_website == 21 ||
                        $id_website == 22 ||
                        $id_website == 23 ||
                        $id_website == 24 ||
                        $id_website == 25 ||
                        $id_website == 26 ||
                        $id_website == 27)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.tautan.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.tautan*') ? 'active' : '' }}">
                            <i class="ri-global-line"></i> <span>Tautan</span>
                        </a>
                    </li>
                @endif
                @if ($id_website == 13 || $id_website == 14)
                    <li class="nav-item">
                        <a href="{{ route('setjenweb.testimonial.index') }}"
                            class="nav-link {{ request()->routeIs('setjenweb.testimonial*') ? 'active' : '' }}">
                            <i class="ri-thumb-up-line"></i> <span>Daftar Testimonial</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="nav-group show">
            <a href="#" class="nav-label">Pengaturan</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('setjenweb.website.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.website*') ? 'active' : '' }}">
                        <i class="ri-folder-2-line"></i> <span>Website</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setjenweb.organisasi.index') }}"
                        class="nav-link {{ request()->routeIs('setjenweb.organisasi*') ? 'active' : '' }}">
                        <i class="ri-folder-2-line"></i> <span>Struktur Organisasi</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
            <div class="sidebar-footer-thumb">
                @if (session('portal_data')->nip)
                    {{-- Jika NIP ada, tampilkan gambar profil menggunakan nilai NIP --}}
                    <img src="https://berkas.dpr.go.id/portal/photos/{{ session('portal_data')->nip }}.jpg"
                        alt="Foto Profil">
                @else
                    {{-- Jika NIP tidak ada atau kosong, periksa digit keempat dari belakang untuk menentukan gambar default sesuai jenis kelamin --}}
                    @php
                        $digitKeempatTerakhir = substr(session('portal_data')->nip, -4, 1);
                    @endphp

                    @if ($digitKeempatTerakhir === '1')
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user_man.png') }}"
                            alt="Foto Profil">
                    @elseif ($digitKeempatTerakhir === '0')
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user_girl.png') }}"
                            alt="Foto Profil">
                    @else
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user.png') }}" alt="Foto Profil">
                    @endif
                @endif

            </div>
            <div class="sidebar-footer-body">
                <h6><a href="#">{{ session('portal_data')->nama }}</a></h6>
                <p>{{ session('portal_data')->peran['eperformance'] }}</p>
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
                <a href="https://portal.dpr.go.id/"><i class="ri-question-line"></i> Pusat Bantuan</a>
                <a href="https://portal.dpr.go.id/"><i class="ri-lock-line"></i> Pengaturan Privasi</a>
                <a href="https://portal.dpr.go.id/"><i class="ri-user-settings-line"></i> Pengaturan Akun</a>
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
