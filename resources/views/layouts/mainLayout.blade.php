<!DOCTYPE html>

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('assets/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL::asset('assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ URL::asset('vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="{{ URL::asset('css/examples.css') }}" rel="stylesheet">
</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">

    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{route('main')}}"><img src="{{ asset('assets/img/turkuvaz.png') }}" width="105" height="47" alt="Turkuvaz Logo"></a>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('assets/brand/coreui.svg#signet') }}"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-title">Menü</li>

        <li class="nav-item"><a class="nav-link" href="{{route('addUser')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{route('addUser')}}"></use>
                </svg> Kullanıcı Ekle</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('listUserPost')}}">
                <svg class="nav-icon">
                    <use xlink:href="{{route('listUserPost')}}"></use>
                </svg> Kullanıcı Listele</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('categoryAddPost')}}">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                </svg> Kategori Ekle</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('categoryListPost')}}">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                </svg> Kategori Listele</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('productAddPost')}}">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                </svg> Ürün Ekle</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('productListPost')}}">
                <svg class="nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                </svg> Ürün Listele</a></li>
    </div>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                </svg>
            </button><a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{{ asset('assets/brand/coreui.svg#full')}}"></use>
                </svg></a>

            <ul class="header-nav ms-3">
                <a href="{{route('logout')}}" class="btn btn-primary" type="submit">Çıkış</a>
            </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
            @yield('content')
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
        </div>
    </div>
    <footer class="footer">
    </footer>
</div>
<!-- CoreUI and necessary plugins-->
<script src="{{ URL::asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
<script src="{{ URL::asset('vendors/simplebar/js/simplebar.min.js') }}"></script>
<script>
</script>
</body>
</html>
