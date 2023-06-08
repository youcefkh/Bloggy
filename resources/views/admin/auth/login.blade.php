<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog </title>

    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/base/vendor.bundle.base.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" />
</head>

<body >
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
{{--                            <img src="../../images/logo.svg" alt="logo">--}}
                        </div>
                        <h4>Hello Again</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form class="pt-3" action="{{ route('adminLoginPost') }}" method="post">
                            @csrf
                            @if(\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ \Session::get('success') }}

                                </div>
                            @endif
                            {{ \Session::forget('success') }}
                            @if(\Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ \Session::get('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block font-red-mint">
                                       <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block font-red-mint">
                                       <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

    <script src="{{asset('assets/js/todolist.js')}}" ></script>
    <script src="{{asset('assets/vendors/base/vendor.bundle.base.js')}}" ></script>
    <script src="{{asset('assets/js/off-canvas.js')}}" ></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}" ></script>
    <script src="{{asset('assets/js/template.js')}}" ></script>
</body>
</html>