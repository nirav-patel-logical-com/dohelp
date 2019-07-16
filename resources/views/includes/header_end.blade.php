<?php
$site_path = env('APP_URL');
$site_path = $site_path.'public/';
?>        <!-- Bootstrap CSS -->
        <link href="{{$site_path}}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- App CSS -->
        <link href="{{$site_path}}assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="{{$site_path}}assets/js/modernizr.min.js"></script>

    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            @include('includes.topbar')
            @include('includes.leftbar')

