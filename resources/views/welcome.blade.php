{{-- @extends('layouts.app')
@section('content')
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    {{-- <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog</title>
    <!-- plugins:css -->
    <link href="{{ asset('assets/vendors/base/vendor.bundle.base.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/css/styles-sp.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles-sp-more.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dsfr/css/dsfr-prefixe.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <link rel="shortcut icon"
        href="{{ config()->get('settings.logo')? asset(config()->get('settings.logo')): asset('assets/image/layout/logo.png') }}" />
    <script type="text/javascript" src="{{ asset('assets/js/lib/modernizr.js') }}"></script>
    <script src="{{ asset('assets/js/ie/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/require.js') }}"></script>
    <script src="{{ asset('assets/js/lib/common.js') }}"></script>
    <script src="{{ asset('assets/js/lib/configRgpd.js') }}"></script>
    <script src="{{ asset('assets/js/ie/expandAllOnIE8.js') }}"></script>
    <script src="{{ asset('assets/js/ie/polyfill.min.js') }}"></script>
    <script type="text/javascript">
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('');
    </script>

    <script src="{{ asset('assets/js/ie/respond.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> 

    <script href="{{ asset('js/app.js') }}" defer></script> --}}

    <meta charset="UTF-8" />
    <meta name="google-site-verification" content="EjfbmjAxVpCGzkyjF4wTemZfr0-HRfRr0Cltkv4VpUs" />
    <meta name="description"
        content="Le site officiel de l’administration française : connaître vos droits, effectuer vos démarches" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="audience" content="particuliers" />
    <meta name="sp_cookie_domain" content="service-public.fr" />
    <meta name="annuaire_root" content="https://lannuaire.service-public.fr" />
    <meta name="sp_root" content="https://www.service-public.fr" />
    <link rel="icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon"
        sizes="16x16 32x32 48x48 64x64" />
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon/favicon-57.png') }}"/>
    <script type="text/javascript" src="{{ asset('assets/js/lib/modernizr.js') }}"></script>

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles-sp.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles-sp-more.min.css') }}" />
    <!--<![endif]-->
    <link href="{{ asset('assets/dsfr/css/dsfr-prefixe.css') }}" rel="stylesheet" />

</head>


<body {{-- lang="{{ str_replace('_', '-', app()->getLocale()) }} " dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"--}}>
    <div id="app">
        <index></index>
    </div>

    <script>
        document.urlResourcesRoot = "assets";
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/require.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/common.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/configRgpd.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/ie/expandAllOnIE8.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/ie/polyfill.min.js') }}" ></script>
    <script type="text/javascript" >
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="/public/assets/js/ie/polyfill.min.js"><\/script>');
    </script> 
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>

</html>
