<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') - {{config('app.name')}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('assets/admin/css/style.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/admin/css/toastr.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/admin/css/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    @yield('css-header')
    <script>
        var url = "{{url('')}}/";
        var serverUrl = "{{url('admin')}}/";
        var app_url = "{{url('app')}}/";
        var __token = "{{csrf_token()}}";
        var requestToken = "{{csrf_token()}}";
    </script>
    @yield('js-header')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.layouts.sidebar')
        
        <div id="content-wrapper" class="d-flex flex-column">
            
            @include('admin.layouts.header')
            <!-- Main Content -->
            <div id="content">
                @yield('content')
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
    <script src="{{url('assets/admin/js/all-scripts.min.js')}}"></script>
    {{-- <script src="{{url('assets/admin/js/toastr.min.js')}}"></script>
    <script src="{{url('assets/admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/admin/js/sweetalert2.all.min.js')}}"></script> --}}
    <script src="{{url('assets/admin/js/custom-plugin.js')}}"></script>
    @yield('js-footer')
</body>
</html>