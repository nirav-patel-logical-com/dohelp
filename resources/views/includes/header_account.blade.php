<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{env('APP_URL')}}public/assets/images/favicon.ico">

        <!-- App title -->
        @yield('seo-tag')

        <!-- Bootstrap CSS -->
        <link href="{{env('APP_URL')}}public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{env('APP_URL')}}public/assets/css/style.css" rel="stylesheet" type="text/css"/>

        <link href="{{env('APP_URL')}}public/assets/css/custom.css" rel="stylesheet" type="text/css"/>

        <script src="{{env('APP_URL')}}public/assets/js/modernizr.min.js"></script>

        <!-- Page Include Start -->
        @yield('header-pages-include')
        <!-- Page Include End -->

    </head>


    <body>
