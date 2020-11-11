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

<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b> {{ config('app.name') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if (session('faild'))
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-ban"></i>
                    {{ session('faild') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
            </div>
            <p class="mb-1">
                <a href="{{ route('admin.forgot') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
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
<script src="{{ asset('back/js/main.js') }}"></script>
@stack('scripts')

</body>
</html>
