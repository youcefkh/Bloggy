<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog</title>
    <!-- plugins:css -->
    <link href="{{asset('assets/vendors/base/vendor.bundle.base.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/styles-sp.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/styles-sp-more.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/dsfr/css/dsfr-prefixe.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script href="{{asset('js/app.js')}}" defer></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <link rel="shortcut icon" href="{{config()->get('settings.logo')?asset(config()->get('settings.logo')):asset('assets/image/layout/logo.png')}}" />
    <script type="text/javascript" src="{{asset('assets/js/lib/modernizr.js')}}"></script>
    <script src="{{asset('assets/js/ie/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/require.js')}}"></script>
    <script src="{{asset('assets/js/lib/common.js')}}"></script>
    <script src="{{asset('assets/js/lib/configRgpd.js')}}"></script>
    <script src="{{asset('assets/js/ie/expandAllOnIE8.js')}}"></script>
    <script src="{{asset('assets/js/ie/polyfill.min.js')}}"></script>
    <script type="text/javascript">
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('');
    </script>

    <script src="{{asset('assets/js/ie/respond.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

</head>


<body lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() =="ar"?'rtl':'ltr'}}">
<div id="app">
    <header class="banner" role="banner">

        <div class="nav-top">
            <div class="container">

                <nav class="nav-top-main" role="navigation" aria-label="menu principal">
                    <ul>
                        <li class="nav-top-menu">
                            <button id="nav-open-btn" onclick="openNav()" aria-controls="nav-mobile" aria-expanded="true" class="btn btn-menu nav-top-menu" type="button">menu
                            </button>
                        </li>
                        <li class="nav-top-part"  style="float: {{app()->getLocale() == "ar"?'right':'left'}}">
                            <a href="{{url('/')}}" class="active" title="Domicile - actif" data-xiti-name="Particuliers::Particuliers::Accueil::Accueil">
                                {{__('element.navbar.home')}}
                            </a>
                        </li>
                        <li class="nav-top-pro"  style="float: {{app()->getLocale() == "ar"?'right':'left'}}">
                            <a  href="#" title="Entreprendre - Nouvelle fenêtre" data-xiti-name="Professionnels::Particuliers::Accueil::Accueil">
                                {{__('element.navbar.about-us')}}
                            </a>
                        </li>
                        <li class="nav-top-asso"  style="float: {{app()->getLocale() == "ar"?'right':'left'}}">
                            <a href="#" data-xiti-name="Associations::Particuliers::Accueil::Accueil">
                                {{__('element.navbar.privacy')}}
                            </a>
                        </li>
                        <li class="nav-top-annuaire"  style="float: {{app()->getLocale() == "ar"?'right':'left'}}">
                            <a href="#" data-xiti-name="Annuaire::Particuliers::Accueil::Accueil">
                                {{__('element.navbar.terms')}}
                            </a>
                        </li>
                        <li class="nav-top-compte  "  style="float: {{app()->getLocale() == "ar"?'left':'right'}}">
                            <ul class="list-group list-group-horizontal-sm">
                                <li class="list-group-item"><a href="#"  ><span class="ti-facebook" aria-hidden="true"></span></a></li>
                                <li class="list-group-item"><a href="#"  ><span class="ti-twitter" aria-hidden="true"></span></a></li>
                                <li class="list-group-item"><a href="#"  ><span class="ti-linkedin" aria-hidden="true"></span></a></li>
                                <li class="list-group-item"><a href="#"  ><span class="ti-youtube" aria-hidden="true"></span></a></li>
                                <li class="list-group-item"><a href="#"  ><span class="ti-instagram" aria-hidden="true"></span></a></li>
                            </ul>

                        </li>
                    </ul>
                </nav>

            </div>
        </div>

    <div class="container container-logo">
        <div class="logo d-flex" style="float: {{app()->getLocale() == "ar"?'right':'left'}}">
            <img data-test="img-non-deuil" class="img-marianne" src="{{config()->get('settings.logo')?asset(config()->get('settings.logo')):'https://www.service-public.fr/resources/v-a0de4bc5fc/web/img/republique-francaise.png'}}" alt="{{config()->get('settings.title')}}" width="150" height="130" />
            <a href="{{url('/')}}" style="float: {{app()->getLocale() == "ar"?'left':'right'}};margin-left:  {{app()->getLocale() == "ar"?'0px':'15px'}};margin-right:  {{app()->getLocale() == "ar"?'15px':'0px'}};">
                <h4  style="font-family: Inter,Sans-serif;font-weight: 200;font-size: 33px;">{{config()->get('settings.title')}}</h4>
                <h6   style="font-family: Inter,Sans-serif;font-weight: 100;font-size: 23px;">{{config()->get('settings.subtitle')}}</h6>
            </a>
        </div>
        <div class="nav-header" style="float: {{app()->getLocale() == "ar"?'left':'right'}}">
            <ul>
                <li class="nav-header-1">
                    <a href="#">
                        <svg focusable="false" style="float: {{app()->getLocale() == "ar"?'right':'left'}}" width="35" height="35" class="icon-question" aria-hidden="true"><use xlink:href="#icon-question"></use></svg>
                        {{__('text.home.a-question-?')}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
        <nav class="nav-mobile" id="nav-mobile" role="navigation" aria-label="menu Particuliers (affichage mobile)">
            <p class="nav-mobile-close">
                <button id="nav-close-btn" onclick="closeNav()" class="btn btn-close" type="button" title="Fermer le menu Particuliers">
                    Fermer
                </button>
            </p>
            <div class="nav-mobile-espace">
                <p><a>Category 1 Only (Limit 10)</a></p>
                <ul>
                    <li><a href="#">Article 1</a></li>
                    <li><a href="#">Article 2</a></li>
                    <li><a href="#">Article 3</a></li>
                    <li><a href="#">Article 4</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <nav class="nav-main" id="nav-main" role="navigation" aria-label="menu Particuliers">
        <div class="container">
            <ul class="nav-main-first nav-main-desktop" id="nav-main-dropdown">
                <li class="active" data-test="Accueil_active">
                    <a class="nav-main-item nav-main-home" href="{{url('/')}}" title="Accueil - actif">
                        <span class="icon icon-home" aria-hidden="true"></span><span class="blank"> {{__('element.navbar.home')}}</span>
                    </a>
                </li>
                @foreach(config()->get('categories') as $category)
                <li class="panel">
                    <a
                            class="nav-main-item"
                            href="#"
                            data-parent="#nav-main-dropdown"
                            data-toggle="collapse"
                            data-target="#nav-main-cat{{$category->id}}"
                            data-xiti-type="navigation"
                    >
                        {{app()->getLocale()=="ar"?$category->name_ar:$category->name}}
                    </a>
                    <div class="nav-main-dropdown-inner collapse" id="nav-main-cat{{$category->id}}">
                        <div class="container">
                            <p class="close">
                                <button class="btn-close" type="button" data-target="#nav-main-cat{{$category->id}}">{{__('button.home.close')}}</button>
                            </p>
                            @for($i=0;$i < count($category->subcategories)  ;$i++)
                            <div class="nav-main-sous-theme" role="list">
                                <div class="col-nav-main" role="presentation">

                                    <div role="listitem">

                                        <p>{{app()->getLocale()=="ar"?$category->subcategories[$i]->name_ar:$category->subcategories[$i]->name}}</p>
                                        <ul>
                                            @foreach($category->subcategories[$i]->articles as $article)
                                               <li><a href="#">{{app()->getLocale()=="ar"?$article->title_ar:$article->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    @if( $i+1<count($category->subcategories) && $category->subcategories[$i+1])
                                    <div role="listitem">
                                        <p>{{app()->getLocale()=="ar"?$category->subcategories[$i+1]->name_ar:$category->subcategories[$i+1]->name}}</p>
                                        <ul>
                                            @foreach($category->subcategories[$i+1]->articles as $article)
                                                <li><a href="#">{{app()->getLocale()=="ar"?$article->title_ar:$article->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endfor

                            <p class="link-theme"><a href="#">{{__('button.home.show-all')}}</a></p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="search" role="search" id="search">
        <form id="recherche" method="post" action="{{url('/'.app()->getLocale().'/suggestion')}}" class="search-site">
            @csrf
            <div class="container">

                <div class="input-group">
                    <input
                            type="search"
                            class="form-control"
                            id="keyword"
                            title="Recherche dans l&#39;espace Particuliers (Exemple : Passeport, mairie de Montreuil, acte de naissance…)"
                            autocomplete="off"
                            name="keyword"
                            placeholder="Exemple : Passeport, mairie de Montreuil, acte de naissance…"
                            maxlength="300"
                            data-test="search-input"
                            aria-label="Recherche dans l&#39;espace Particuliers (Exemple : Passeport, mairie de Montreuil, acte de naissance…)"
                            value=""
                    />
                    <span class="input-group-btn">
                                    <button class="btn" type="submit" title="Rechercher dans service-public.fr" data-xiti-name="recherche::Particuliers::Accueil::Accueil" data-xiti-type="action">
                                        <span aria-hidden="true" class="icon icon-search"></span><span class="blank" data-test="search-button">Rechercher dans service-public.fr</span>
                                    </button>
                                </span>
                </div>
            </div>
        </form>
    </div>
{{--        <div class="container-fluid page-body-wrapper">--}}
{{--            @include('admin.layouts.partials.sidebar')--}}
            <main class="main-panel">
                @yield('content')
            </main>
{{--        </div>--}}
{{--    </div>--}}
    <script type="text/javascript">
        function openNav(){
           document.querySelector('.nav-mobile').style.display='block';
           document.querySelector('.nav-mobile').style.left='18em';
        }
        function closeNav(){
            document.querySelector('.nav-mobile').style.display='none';
        }
    </script>
</div>
</body>