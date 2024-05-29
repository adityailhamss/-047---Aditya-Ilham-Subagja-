<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title') - {{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ asset('css/main/app.css') }}" />
  <link rel="shortcut icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="{{ asset('css/shared/iconly.css') }}" />
  @vite([])
</head>

<body>
  <script src="{{ asset('js/initTheme.js') }}"></script>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
          <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
              <a href="">{{ config('app.name') }}</a>
            </div>
            
            <div class="sidebar-toggler x">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        @auth('administrator')
        @include('layouts.administrator.sidebar')
        @endauth

        @auth('officer')
        @include('layouts.officer.sidebar')
        @endauth

        @auth('student')
        @include('layouts.student.sidebar')
        @endauth
      </div>
    </div>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        <div class="page-title">
          <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>@yield('title', 'Default title').</h3>
              <p class="text-subtitle text-muted">@yield('description', 'Default description').</p>
            </div>
          </div>
        </div>
        @yield('content')
      </div>

      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>2024 &copy; Pinjamkeun</p>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  @stack('modal')
  @stack('script')

  <script>
    $(function () {
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

      $('.datatable').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 15, 20, 25, 50, -1], [5, 10, 15, 20, 25, 50, "All"]],
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.3/i18n/id.json',
        },
      });

      $('input[type=date]').flatpickr({
        allowInput: true,
      });

      $('.btn-delete').click(function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Yakin?',
          text: "Data tersebut akan dihapus",
          icon: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya!',
          cancelButtonText: 'Tidak',
        }).then((result) => {
          if (result.isConfirmed) {
            $(this).parent().submit();
          }
        });
      });

      $('.btn-returned').click(function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Kembalikan?',
          text: "Status peminjaman tersebut akan berubah menjadi sudah kembali",
          icon: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya!',
          cancelButtonText: 'Tidak',
        }).then((result) => {
          if (result.isConfirmed) {
            $(this).parent().parent().submit();
          }
        });
      });

      $('.btn-validate').click(function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Validasi?',
          text: "Status validasi peminjaman tersebut akan terisi Anda",
          icon: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya!',
          cancelButtonText: 'Tidak',
        }).then((result) => {
          if (result.isConfirmed) {
            $(this).parent().submit();
          }
        });
      });

      $('#logout').click(function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Keluar?',
          text: "Anda akan keluar dari aplikasi",
          icon: 'warning',
          showCancelButton: true,
          reverseButtons: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya!',
          cancelButtonText: 'Tidak',
        }).then((result) => {
          if (result.isConfirmed) {
            $(this).parent().submit();
          }
        });
      });
    });
  </script>

</body>

</html>
