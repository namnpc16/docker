<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ mix('back/css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('back/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('back/css/tempusdominus-bootstrap-4.css') }}">    
    {{-- <link rel="stylesheet" href="{{ asset('back/css/.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('back/css/main.css?id=').date('YmdHis') }}">
    @stack('head')
</head>

<body class="hold-transition sidebar-mini text-sm">
    {{-- ==================================================== --}}
    <div id="myModal-logout" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <div class="modal-body">
                {{-- <input type="hidden" name="delete_id" id="delete_id"> --}}
                <p>Bạn có muốn đăng xuất không ?</p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                <button type="submit" class="btn btn-primary">Có</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- ==================================================== --}}
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a target="_blank" href="#" class="nav-link">Frontend</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                {{-- <a class="dropdown-item logout" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    {{ __('Logout') }}
                </a> --}}
                <a href="#" style="color: #333333" class="logout"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
                {{-- <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form> --}}
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('admin.layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        @yield('buttons')
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->
@stack('scripts-lib')
{{-- <script src="{{ mix('back/js/app.js') }}"></script> --}}
<script src="{{ asset('back/js/jquery.min.js') }}"></script>
<script src="{{ asset('back/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('back/js/moment.min.js') }}"></script>
<script src="{{ asset('back/js/daterangepicker.js') }}"></script>
<script src="{{ asset('back/js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('back/js/summernote-ja-JP.js') }}"></script>
<script src="{{ asset('back/js/sweetalert2.js') }}"></script>
<script src="{{ asset('back/js/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('back/js/select2.js') }}"></script>
<script src="{{ asset('back/js/adminlte.min.js') }}"></script>
<script src="{{ asset('back/js/main.js?id=').date('YmdHis') }}"></script>
<script>
    $(document).ready(function () {
        $(".logout").on("click", function () {
          $("#myModal-logout").modal('show');
        //   $str = $(this).closest('tr');
        //   let data = $str.children('td').map(function () {
        //     return $(this).text();
        //   }).get();
        //   $('#delete_id').val(data[0]);
        })
    });
  </script>
@stack('scripts')

</body>
</html>
