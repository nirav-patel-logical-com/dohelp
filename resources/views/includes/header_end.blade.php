       <!-- Bootstrap CSS -->
        <link href="{{env('APP_URL')}}public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- App CSS -->
        <link href="{{env('APP_URL')}}public/assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="{{env('APP_URL')}}public/assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- Modernizr js -->
        <script src="{{env('APP_URL')}}public/assets/js/modernizr.min.js"></script>

        <!-- Page Include Start -->
        @yield('header-pages-include')
        <!-- Page Include End -->

    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            @include('includes.topbar')
            @include('includes.leftbar')

