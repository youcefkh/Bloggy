<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog Admin</title>
    <!-- plugins:css -->
    <link href="{{asset('assets/vendors/base/vendor.bundle.base.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script href="{{asset('js/app.js')}}" defer></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <link rel="shortcut icon" href="{{config()->get('settings.logo')?asset(config()->get('settings.logo')):asset('assets/image/layout/logo.png')}}" />
    <script src="{{asset('assets/js/todolist.js')}}" ></script>
    <script src="{{asset('assets/vendors/base/vendor.bundle.base.js')}}" ></script>
    <script src="{{asset('assets/js/off-canvas.js')}}" ></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}" ></script>
    <script src="{{asset('assets/js/template.js')}}" ></script>
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}" ></script>
    <script src="{{asset('assets/js/jquery.cookie.js')}}" ></script>
    <script src="{{asset('assets/js/todolist.js')}}" ></script>
    <script src="{{asset('assets/js/dashboard.js')}}" ></script>
    <script src="{{asset('assets/js/file-upload.js')}}" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>


<body>
    <div id="app">
        <div class="container-scroller">
            @include('admin.layouts.partials.navbar')
            <div class="container-fluid page-body-wrapper">
                 @include('admin.layouts.partials.sidebar')
                 <main class="main-panel">
                      @yield('content')
                 </main>
            </div>
        </div>

    </div>
</body>