<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="language" content="English">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="robots" content="index, follow">

    <meta name="title" content="{{ setting('site_meta_title') }}">
    <meta name="description" content="{{ setting('site_meta_description') }}">
    <meta name="keywords" content="{{ setting('site_meta_keywords') }}">
    <meta name="author" content="{{ setting('app_name') }}">
    <title>{{ setting('app_name') }}</title>

    <link rel="icon" type="image/png" sizes="128x128"  href="{{ asset('storage/images/ecommerce/' . setting('favicon')) }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"  rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/bootstrap/css/bootstrap.min.css') }}"  media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/fontawesome/css/all.min.css') }}" media="all">

    <link rel="stylesheet" type="text/css" href="{{ asset('front/style.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/custom.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/responsive.css') }}" media="all">
    <link rel="stylesheet" type="text/css"  href="{{ asset('dashboard/app-assets/vendors/css/extensions/toastr.min.css') }}">

    @stack('style')

    <meta name="theme-color" content="#7367f0">
    <link rel="apple-touch-icon" href="{{ asset('pwa-icon/icon-72x72.png') }}">
    <link rel="manifest" href="/manifest.json">

</head>

<body>
<div class="main">
    <div id="contentRender">
        @yield('content')
    </div>
</div>


<script type="text/javascript" src="{{ asset('front/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/fontawesome/js/all.js') }}"></script>
@stack('script')
<script src="{{ asset('dashboard/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
</body>
</html>
