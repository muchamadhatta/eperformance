<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/admin-dashbyte/dist/assets/img/favicon.png') }}">

    <title>PUSTEKINFO INTERNSHIP | DPR RI</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/lib/prismjs/themes/prism.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/admin-dashbyte/dist/assets/css/style.min.css') }}">
    <!-- DataTables CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        table.dataTable.table-bordered>thead>tr>th,
        table.dataTable.table-bordered>tbody>tr>td {
            border: 1px solid #dee2e6 !important;
        }
    </style>
    @stack('styles')
</head>

<body>

    @include('magangpustekinfo::layouts.sidebar')
    @include('magangpustekinfo::layouts.header')

    <div class="main main-app p-3 p-lg-4">
        @yield('content')
        @include('magangpustekinfo::layouts.footer')
    </div>


    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/script.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/db.data.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/assets/js/db.sales.js') }}"></script>


    <script src="{{ asset('theme/admin-dashbyte/dist/lib/gridjs-jquery/gridjs.production.min.js') }}"></script>
    <script src="{{ asset('theme/admin-dashbyte/dist/lib/prismjs/prism.js') }}"></script>
    <!-- DataTables JS from CDN -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <!-- SweetAlert2 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                // scrollX: "100%", (Removed to prevent flicker)
                order: [
                    [0, 'asc']
                ],
                autoWidth: false,
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                colReorder: true,
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'copy',
                        text: 'Salin'
                    },
                    {
                        extend: 'csv',
                        text: 'CSV'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel'
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF'
                    },
                    {
                        extend: 'print',
                        text: 'Cetak'
                    }
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "›",
                        previous: "‹"
                    }
                },
                initComplete: function() {
                    $(this.api().table().node()).css('visibility', 'visible');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>