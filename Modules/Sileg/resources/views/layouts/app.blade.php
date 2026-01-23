<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin-dashbyte/dist/assets/img/favicon.png') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="http://172.16.31.242/setjen-web/theme/admin-dashbyte/dist/assets/img/favicon.png"> --}}

    <title>Sileg | DPR RI</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.css') }}">

    <!-- Text Editor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.core.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.bubble.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('theme/admin-dashbyte/dist/lib/jquery-timepicker/jquery.timepicker.min.css') }}">

    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jqueryui/jquery-ui.min.js') }}"></script>

    <style>
        .dataTable th.sorting::after,
        .dataTable th.sorting_asc::before,
        .dataTable th.sorting_asc::after,
        .dataTable th.sorting::before,
        .dataTable th.sorting_desc::after,
        .dataTable th.sorting_desc::before {
            content: none !important;
        }
    </style>

    @livewireStyles
</head>

<body id="konten">
    @include('sileg::layouts.sidebar')
    @include('sileg::layouts.header')

    <div class="main main-app p-3 p-lg-4">
        @yield('content')
        @include('sileg::layouts.footer')
    </div>

    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/script.js') }}"></script>
    {{-- <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/db.storage.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/admin-dashbyte/dist/lib/chart.js/chart.min.js') }}"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
     --}}


    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $("table#tableGrid3").each(function() {
                $(this).DataTable({
                    searching: true,
                    sorting: true,
                    paging: true,
                    pageLength: 10,
                    lengthChange: true,
                    info: true,
                    autoWidth: true,
                    responsive: true,
                    ordering: true,
                    resizable: true,
                });

                $(this).addClass('table table-bordered table-striped table-hover border border-collapse');
                $('th').addClass('border p-1 fw-bold align-middle');
                $('td').addClass('border p-1 align-middle');
            });
        });
    </script>

    {{--
    <script>
        $(document).ready(function() {
            $('#tableGrid3').DataTable({
                language: {
                    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ entri",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ total entri)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext": "Selanjutnya",
                        "sLast": "Terakhir"
                    },
                    "oAria": {
                        "sSortAscending": ": aktifkan untuk mengurutkan kolom secara ascending",
                        "sSortDescending": ": aktifkan untuk mengurutkan kolom secara descending"
                    }
                },
                order: [[0, 'desc']] // Assuming your date column is the first column (change 0 to the index of your date column)
            });
        });
    </script> --}}

    <script src="{{ asset('theme/admin-dashbyte/dist/lib/prismjs/prism.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/colorpicker/spectrum.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/quill/quill.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var konten = document.getElementById('konten');
            var ukuranWebsite = document.getElementById('ukuranwebsite');

            ukuranWebsite.addEventListener('click', function(event) {
                event.preventDefault();

                if (event.target.classList.contains('nav-link')) {
                    var zoomLevel = 100;

                    if (event.target.classList.contains('active')) {
                        return;
                    }

                    if (event.target.textContent === 'Sedang') {
                        zoomLevel = 90;
                    } else if (event.target.textContent === 'Kecil') {
                        zoomLevel = 80;
                    }

                    konten.style.zoom = zoomLevel + '%';

                    var aktif = ukuranWebsite.querySelector('.active');
                    aktif.classList.remove('active');
                    event.target.classList.add('active');

                    localStorage.setItem('zoomLevel', zoomLevel);
                }
            });

            var savedZoomLevel = localStorage.getItem('zoomLevel');
            if (savedZoomLevel) {
                konten.style.zoom = savedZoomLevel + '%';
                var aktif = ukuranWebsite.querySelector('.active');
                aktif.classList.remove('active');
                if (savedZoomLevel === '90') {
                    ukuranWebsite.querySelector(':nth-child(2)').classList.add('active');
                } else if (savedZoomLevel === '80') {
                    ukuranWebsite.querySelector(':nth-child(1)').classList.add('active');
                } else {
                    ukuranWebsite.querySelector(':nth-child(3)').classList.add('active');
                }
            }
        });
    </script>

    {{--  grid JS --}}
    {{-- <script src="{{ asset('theme/admin-dashbyte/dist/lib/gridjs-jquery/gridjs.production.min.js') }}"></script>
    <script>
        $("table#tableGrid3").each(function() {
            var $table = $(this);
            if ($table.length > 0) {
                $table.Grid({
                    className: {
                        table: 'table table-bordered mb-0 fs-6'
                    },
                    search: true,
                    pagination: true,
                    sort: true,
                    resizable: true,
                    language: {
                        search: {
                            placeholder: 'Cari...'
                        },
                        pagination: {
                            previous: 'Sebelumnya',
                            next: 'Selanjutnya',
                            showing: 'Menampilkan',
                            results: () => 'Baris',
                            of: 'dari'
                        }
                    }
                });
            }
        });
    </script> --}}
    {{--  grid JS --}}


    <script>
        if (document.getElementById('editor-container')) {
            var quill = new Quill('#editor-container', {
                modules: {
                    toolbar: '#toolbar-container'
                },
                placeholder: 'Masukan...',
                theme: 'snow'
            });
            quill.on('text-change', function() {
                var editorHtml = quill.root.innerHTML;
                document.querySelector('#editor_input').value = editorHtml;
            });
        }
    </script>

    @livewireScripts
    @stack('script')
</body>

</html>
