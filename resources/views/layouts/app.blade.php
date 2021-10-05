<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="api-base-url" content="{{ URL::to('/')}}" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('layouts.styles')
    </head>
    <body>
        <div id="preloader">
		    <div data-loader="circle-side"></div>
        </div><!-- /Preload -->
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            @include('layouts.header')
            <!-- Top Bar End -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        @include('layouts.breadcrumb')
                        <!-- end page-title -->

                        @yield('content')
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->

                @include('layouts.footer')
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->
        <script src="{{ asset('js/app.js') }}"></script>
        @include('layouts.scripts')
    </body>
</html>
