<div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <!-- form-search -->
    <div class="d-flex align-items-center me-auto mt-2">
        <h3 style="font-family: 'cursive'; margin-right: 5px;">{{ $nama_website }}</h3>
            <a class="text-decoration-none" href="https://{{ $url_website }}" target="_blank">
                <i class="ri-global-line" style="font-size: 22px; position: relative;
                top: -2px;"></i>
            </a>
    </div>

    <!-- form-search -->


    <div style="margin-right: 4px">
        <a class="text-decoration-none" href="{{ asset('/setjen') }}"><i class="ri-home-8-line"
                style="font-size: 22px;"></i></a>
    </div>

    <div class="dropdown dropdown-skin">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i
                class="ri-settings-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <label>Skin Mode</label>
            <nav id="skinMode" class="nav nav-skin">
                <a href="" class="nav-link active">Light</a>
                <a href="" class="nav-link">Dark</a>
            </nav>
            <hr>
            <label>Sidebar Skin</label>
            <nav id="sidebarSkin" class="nav nav-skin">
                <a href="" class="nav-link active">Default</a>
                <a href="" class="nav-link">Prime</a>
                <a href="" class="nav-link">Dark</a>
            </nav>
            <hr>
            <label>Ukuran</label>
            <nav id="ukuranwebsite" class="nav nav-skin">
                <a href="" class="nav-link active">Kecil</a>
                <a href="" class="nav-link">Sedang</a>
                <a href="" class="nav-link">Besar</a>
            </nav>

            {{-- <label>Direction</label>
            <nav id="layoutDirection" class="nav nav-skin">
                <a href="" class="nav-link active">LTR</a>
                <a href="" class="nav-link">RTL</a>
            </nav> --}}
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->

    <!-- dropdown -->
    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="avatar online">
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
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user_man.png') }}" alt="Foto Profil">
                    @elseif ($digitKeempatTerakhir === '0')
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user_girl.png') }}" alt="Foto Profil">
                    @else
                        <img src="{{ asset('theme/admin-dashbyte/dist/assets/img/user.png') }}" alt="Foto Profil">
                    @endif
                @endif

            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <div class="dropdown-menu-body">
                <div class="avatar avatar-xl online mb-3">

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
                <h5 class="mb-1 text-dark fw-semibold">{{ session('portal_data')->nama }}
                </h5>
                <p class="fs-sm text-secondary">{{ session('portal_data')->peran['eperformance'] }}
                </p>

                <hr>
                <nav class="nav">
                    {{-- <a href=""><i class="ri-question-line"></i> Pusat Bantuan</a>
                    <a href=""><i class="ri-lock-line"></i> Pengaturan Privasi</a>
                    <a href=""><i class="ri-user-settings-line"></i> Pengaturan Akun</a> --}}
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-logout-box-r-line"></i> Keluar
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </div><!-- dropdown-menu-body -->
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
</div><!-- header-main -->
