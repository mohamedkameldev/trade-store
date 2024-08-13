<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - @yield('title', 'Page') </title>
    {{-- <title>{{ config('app')['name'] }} - @yield('title', 'Page') </title> --}}
    {{-- <title>{{ config('app.name') }}</title> --}}
    <link rel="icon" href={{asset('dist/img/icon.png')}} type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    @stack('styles')
    {{--استخدمه لما يبقى الفيو الابن محتاج لينكات الباقي مش محتاجها--}}
    {{--لما تحتاج تضيف لينك تبقى تعمل push--}}
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        {{-- @dump(Route::current()->uri)
        @dump(Route::currentRouteName())
        @dd(Route::currentRouteAction()) --}}

        @include('layouts.partials.nav')

        {{-- @include('layouts.partials.sidebar') --}}
        <x-sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            @yield('button')
                        </div><!-- /.col -->
                        <div class="col-sm-4">
                            <h1 class="m-0">@yield('title', 'Page')</h1> {{-- default value for this section--}}
                        </div><!-- /.col -->
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Index</a></li>
                                @show
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        {{-- @include('layouts.partials.controlsidebar') --}}

        {{-- @include('layouts.partials.footer') --}}

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    @stack('scripts')
    {{--لما تحتاج تضيف لينك هنا تبقى تعمل push--}}
</body>

</html>