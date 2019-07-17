<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <?php
        $site_path = env('APP_URL');
        $site_path = $site_path.'public/';
        ?>
        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{$site_path}}assets/images/favicon.ico">

        <!-- App title -->
        <title>Man Help</title>

        <!-- Bootstrap CSS -->
        <link href="{{$site_path}}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="{{$site_path}}assets/css/style.css" rel="stylesheet" type="text/css"/>

        <link href="{{$site_path}}assets/css/custom.css" rel="stylesheet" type="text/css"/>

        <script src="{{$site_path}}assets/js/modernizr.min.js"></script>

    </head>


    <body>
