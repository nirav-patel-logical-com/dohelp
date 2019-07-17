        <script>
            var resizefunc = [];
        </script>
        <?php
        $site_path = env('APP_URL');
        $site_path = $site_path.'public/';
        ?>
        <!-- jQuery  -->
        <script src="{{$site_path}}assets/js/jquery.min.js"></script>
        <script src="{{$site_path}}assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{$site_path}}assets/js/detect.js"></script>
        <script src="{{$site_path}}assets/js/fastclick.js"></script>
        <script src="{{$site_path}}assets/js/jquery.blockUI.js"></script>
        <script src="{{$site_path}}assets/js/waves.js"></script>
        <script src="{{$site_path}}assets/js/jquery.nicescroll.js"></script>
        <script src="{{$site_path}}assets/js/jquery.scrollTo.min.js"></script>
        <script src="{{$site_path}}assets/js/jquery.slimscroll.js"></script>
        <script src="{{$site_path}}plugins/switchery/switchery.min.js"></script>
        <script src="{{$site_path}}assets/js/bsp_script.js" type="text/javascript"></script>
        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="{{$site_path}}assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="{{$site_path}}plugins/jquery-knob/jquery.knob.js"></script>


        <script src="{{$site_path}}plugins/multiselect/js/jquery.multi-select.js"></script>
        <!-- Peity chart js -->
        <script src="{{$site_path}}plugins/peity/jquery.peity.min.js"></script>

        <!-- App js -->
        <script src="{{$site_path}}assets/js/jquery.core.js"></script>
        <script src="{{$site_path}}assets/js/jquery.app.js"></script>

    </body>
</html>