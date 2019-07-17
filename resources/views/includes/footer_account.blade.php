        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{env('APP_URL')}}public/assets/js/jquery.min.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/detect.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/fastclick.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/jquery.blockUI.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/waves.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/jquery.nicescroll.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/jquery.scrollTo.min.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/jquery.slimscroll.js"></script>
        <script src="{{env('APP_URL')}}public/plugins/switchery/switchery.min.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/bsp_script.js" type="text/javascript"></script>
        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="{{env('APP_URL')}}public/assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="{{env('APP_URL')}}public/plugins/jquery-knob/jquery.knob.js"></script>


        <script src="{{env('APP_URL')}}public/plugins/multiselect/js/jquery.multi-select.js"></script>
        <!-- Peity chart js -->
        <script src="{{env('APP_URL')}}public/plugins/peity/jquery.peity.min.js"></script>

        <!-- App js -->
        <script src="{{env('APP_URL')}}public/assets/js/jquery.core.js"></script>
        <script src="{{env('APP_URL')}}public/assets/js/jquery.app.js"></script>

        <!-- Page Include and js code start -->
        @yield('footer-pages-include')
        <!-- Page Include and js code End -->

    </body>
</html>